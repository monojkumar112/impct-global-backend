<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(fn (Service $service) => $service->toApiArray());

        return response()->json($services);
    }
}
