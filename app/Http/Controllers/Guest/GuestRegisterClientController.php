<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestRegisterClientController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('guest.register-client', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home')],
                ['title' => 'Register as User', 'url' => null],
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'email' => 'required|email|max:100|unique:users,email',
            'name' => 'required|string|min:8|max:100',
            'password' => 'required|min:8|max:100|confirmed',
        ]);

        try {
            // Use a transaction to ensure data integrity
            DB::transaction(function () use ($validated) {

                User::create([
                    'email' => $validated['email'],
                    'name' => $validated['name'],
                    'password' => $validated['password'], // auto hashed via User model cast
                    'role' => 'Client',
                ]);

            });

            // Redirect to login with success message
            return redirect()
                ->route('login')
                ->with('register_success', 'Registration successful. You can now log in.');

        } catch (\Throwable $e) {

            report($e); // logs it

            // Back with error message
            return back()
                ->withInput()
                ->with('register_error', 'Registration failed. Please try again.');
        }

    }
}
