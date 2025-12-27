<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminClientController extends Controller
{
    public function index()
    {
        $clients = $this->read();

        return view('admin.clients', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Clients', 'url' => null],
            ],
        ], compact('clients'));
    }

    // for testing only, may replace public to private later
    public function read()
    {
        return User::where('role', 'Client')->orderBy('email')->get();
    }

}
