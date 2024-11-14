<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function view()
    {
        $user = Auth::user();

        $headerData = [
            'title' => 'Movie World'
        ];
        View::share('header_data', $headerData);

        return view('dashboard', [
            'sessionExists' => (bool)$user,
            'user_name' => !empty($user->name) ? $user->name : null,
            'user_id' => !empty($user->id) ? $user->id : null,
        ]);

    }

}
