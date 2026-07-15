<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;

class ContactPageController extends Controller
{
    public function show()
    {
        $page = ContactPage::query()->first();

        return response()->json($page ? $page->toApiArray() : []);
    }
}
