<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home')],
                ['title' => 'Login', 'url' => null],
            ],
        ]);
    }

    public function submitForm(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (! Auth::attempt($credentials)) {

            // Back with error message
            return back()
                ->with('auth_error', 'Invalid email or password.')
                ->onlyInput('email');

        }

        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        // Redirect based on role
        return match (Auth::user()->role) {
            'Admin' => redirect()->route('admin.dashboard.index'),
            'Therapist' => redirect()->route('therapist.dashboard.index'),
            'Client' => redirect()->route('client.home.index'),
            default => redirect('/'),
        };

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    
}
