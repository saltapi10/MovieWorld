<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

abstract class Controller
{

    public function __construct()
    {
        $user = Auth::user();
        View::share ( 'sessionExists' , (bool)$user);
        View::share ( 'user_name' , !empty($user->name) ? $user->name : null);
        View::share ( 'user_id' , !empty($user->id) ? $user->id : null);
    }

}
