<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function view()
    {
        $user = Auth::user();

        return view('dashboard', [
            'sessionExists' => (bool)$user,
            'user_name' => !empty($user->name) ? $user->name : null,
            'user_id' => !empty($user->id) ? $user->id : null,
        ]);

    }

}
