<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HowWeWork;

class HowWeWorkController extends Controller
{
    public function index()
    {
        $items = HowWeWork::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(fn (HowWeWork $item) => $item->toApiArray());

        return response()->json($items);
    }
}
