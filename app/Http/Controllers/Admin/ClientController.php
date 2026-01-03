<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ClientUserService;

class ClientController extends Controller
{
    private ClientUserService $clientService;

    public function __construct(ClientUserService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {

        $clients = $this->clientService->getAll();

        return view('admin.client.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Clients', 'url' => null],
            ],
        ], compact('clients'));
    }
}
