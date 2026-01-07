<?php

namespace App\Http\Controllers\Admin;

use App\Actions\User\GetAllClientUsersAction;
use App\Http\Controllers\Controller;

class ClientUserController extends Controller
{


    /**
     * Display all client users
     * 
     */
    public function index(GetAllClientUsersAction $action)
    {

        $clients = $action->run();

        return view('admin.clients.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Clients', 'url' => null],
            ],
        ], compact('clients'));
    }

    // Additional methods can be added here

}
