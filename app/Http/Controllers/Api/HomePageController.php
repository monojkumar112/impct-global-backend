<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomePage;

class HomePageController extends Controller
{
    public function show()
    {
        $page = HomePage::query()->first();

        return response()->json($page ? $page->toApiArray() : []);
    }
}
