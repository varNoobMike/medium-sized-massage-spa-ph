<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ClientUserService;

class ClientController extends Controller
{

    public function __construct(private ClientUserService $clientService) {}


    public function index()
    {

        $clients = $this->clientService->getAllClients();

        return view('admin.clients.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Clients', 'url' => null],
            ],
        ], compact('clients'));
    }

    // Additional methods can be added here

}
