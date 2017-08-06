<?php

namespace Tests\Unit;

use App\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ConcertTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_can_return_formatted_date()
    {
        $concert = new Concert(['date' => Carbon::parse('2016-12-01 8:00pm')]);
        $this->assertEquals('December 1, 2016', $concert->formatted_date);
    }

    /** @test */
    public function it_can_return_formatted_start_time()
    {
        $concert = new Concert(['date' => Carbon::parse('2016-12-01 17:00:00 ')]);
        $this->assertEquals('5:00pm', $concert->formatted_start_time);
    }

    /** @test */
    public function it_can_return_ticket_price_in_dollars()
    {
        $concert = new Concert(['ticket_price' => 6750]);
        $this->assertEquals('67.50', $concert->ticket_price_in_dollars);
    }

    /** @test */
    public function concerts_with_a_published_at_date_are_published()
    {
        $published_concert_1 = factory(Concert::class)->create(['published_at' => Carbon::parse('-1 week')]);
        $published_concert_2 = factory(Concert::class)->create(['published_at' => Carbon::parse('-1 week')]);
        $unpublished_concert = factory(Concert::class)->create(['published_at' => null]);

        $published_concerts = Concert::published()->get();
        $this->assertTrue($published_concerts->contains($published_concert_1));
        $this->assertTrue($published_concerts->contains($published_concert_2));
        $this->assertFalse($published_concerts->contains($unpublished_concert));
    }

    /** @test */
    public function it_can_order_concert_tickets()
    {
        $concert = factory(Concert::class)->create();

        $order = $concert->orderTickets('test@example.com', 3);
        $this->assertEquals('test@example.com', $order->email);
        $this->assertEquals(3, $order->tickets()->count());
    }
}
