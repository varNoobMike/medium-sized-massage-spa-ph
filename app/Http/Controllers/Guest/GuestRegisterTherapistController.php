<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestRegisterTherapistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guest.register-therapist', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home')],
                ['title' => 'Register as Therapist', 'url' => null],
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        // Validate the incoming request data
        $validated = $request->validate([
            'email' => 'required|email|max:100|unique:users,email',
            'name' => 'required|string|min:8|max:100',
            'password' => 'required|min:8|max:100|confirmed',
        ]);

        try {
            // Use a transaction to ensure data integrity
            DB::transaction(function () use ($validated) {

                $user = User::create([
                    'email' => $validated['email'],
                    'name' => $validated['name'],
                    'password' => $validated['password'], // auto hashed via User model cast
                    'role' => 'Client',
                ]);

                // Attach to spa pivot table
                $user->spas()->sync([$spaID]);

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
                */
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
