<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestLoginController extends Controller
{
    public function create()
    {
        return view('guest.login');
    }

    public function store(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials)) {

            return back()
                ->with('auth_error', 'Invalid email or password.')
                ->onlyInput('email');

        }

        $request->session()->regenerate();
        
        return match (Auth::user()->role) {
            'Admin'  => redirect()->route('admin.dashboard.index'),
            'Therapist'  => redirect()->route('therapist.dashboard.index'),
            'Client' => redirect()->route('client.home.index'),
            default  => redirect('/'),
        };

    }
}
