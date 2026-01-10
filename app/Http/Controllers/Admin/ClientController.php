<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\User\ClientService;


class ClientController extends Controller
{

    /**
     * Constructor
     * 
     */
    public function __construct(private ClientService $service) {}

    /**
     * Display clients
     * 
     */
    public function index()
    {
        $clients = $this->service->getClients();

        return view('admin.clients.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Clients', 'url' => null],
            ],
        ], compact('clients'));
    }
}
