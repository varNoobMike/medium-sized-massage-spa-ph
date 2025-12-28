<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SpaContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestRegisterClientController extends Controller
{
    public function index()
    {

        return view('guest.register-client', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home')],
                ['title' => 'Register as User', 'url' => null],
            ],
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'email' => 'required|email|max:100|unique:users,email',
            'name' => 'required|string|min:8|max:100',
            'password' => 'required|min:8|max:100|confirmed',
        ]);

        $spaID = SpaContext::getMainBranchID(); // Main Branch Spa ID

        try {
            // Use a transaction to ensure data integrity
            DB::transaction(function () use ($validated, $spaID) {
                $user = User::create([
                    'email' => $validated['email'],
                    'name' => $validated['name'],
                    'password' => $validated['password'], // auto hashed via User model cast
                    'role' => 'Client',
                ]);

                $user->spas()->syncWithoutDetaching([$spaID]); // insert row at pivot table

            });

        } catch (\Throwable $e) {

            report($e); // logs it

            // Back with error message
            return back()
                ->withInput()
                ->with('register_error', 'Registration failed. Please try again.');
        }

        // Redirect to login with success message
        return redirect()
            ->route('login')
            ->with('register_success', 'Registration successful. You can now log in.');

    }

    
}
