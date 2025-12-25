<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestHomeController extends Controller
{
    public function __invoke()
    {
        return view('guest.index');
    }
}
