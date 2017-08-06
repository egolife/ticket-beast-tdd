<?php

namespace App\Http\Controllers;

use App\Concert;

class ConcertsController extends Controller
{
    public function show(Concert $concert)
    {
        if (!$concert->published_at) {
            abort(404);
        }

        return view('concerts.show')->with(compact('concert'));
    }
}
