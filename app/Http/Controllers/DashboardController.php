<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\Movie;

class DashboardController extends Controller
{
    public function view()
    {

        $headerData = [
            'title' => 'Movie World'
        ];
        View::share('header_data', $headerData);

        $orderOfMovies = Session::get('orderMovies', 'dates');

        $result = (new Movie())->getAllMovies(null, $orderOfMovies);

        return view('dashboard', [
            'movies' => $result['movies'],
            'movies_reactions' => $result['movies_reactions'],
            'sort_order_movies' => $orderOfMovies
        ]);

    }

}
