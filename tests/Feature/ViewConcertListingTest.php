<?php

namespace Tests\Feature;

use App\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewConcertListingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_a_published_concert_listing()
    {
        $concert = factory(Concert::class)->states('published')->create([
            'title'                  => 'The Red Chord',
            'subtitle'               => 'with Animosity and Lethargy',
            'date'                   => Carbon::parse('2016-12-13 20:00:00'),
            'ticket_price'           => 3250, //in cents
            'venue'                  => 'The Mosh Pit', //место
            'venue_address'          => '123 Example Lane',
            'city'                   => 'Laraville',
            'state'                  => 'ON',
            'zip'                    => '17916',
            'additional_information' => 'For tickets, call (555) 555-5555.',
        ]);

        $this->get('/concerts/' . $concert->id)
            ->assertSee('The Red Chord')
            ->assertSee('with Animosity and Lethargy')
            ->assertSee('December 13, 2016')
            ->assertSee('8:00pm')
            ->assertSee('32.50')
            ->assertSee('The Mosh Pit')
            ->assertSee('123 Example Lane')
            ->assertSee('Laraville, ON 17916')
            ->assertSee('For tickets, call (555) 555-5555.');
    }

    /** @test */
    public function user_cannot_view_unpublished_concert_listings()
    {
        $concert = factory(Concert::class)->states('unpublished')->create();
        $this->get('/concerts/' . $concert->id)->assertStatus(404);
    }
}
