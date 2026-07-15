<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;

class AboutPageController extends Controller
{
    public function show()
    {
        $page = AboutPage::query()->first();

        return response()->json($page ? $page->toApiArray() : []);
    }
}
