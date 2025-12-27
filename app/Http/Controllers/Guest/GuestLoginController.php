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

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $role = Auth::user()->role;
            $route = 'admin.dashboard.index';

            if ($role === 'Client') {
                $route = 'client.home.index';
            }

            return redirect()->intended(route($route));
        }

        return back()
            ->with('auth_error', 'Invalid email or password.')
            ->onlyInput('email');

    }
}
