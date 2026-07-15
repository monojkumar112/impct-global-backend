<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function edit()
    {
        $contactPage = ContactPage::query()->firstOrCreate(['id' => 1]);

        return view('admin.contact_page.edit', compact('contactPage'));
    }

    public function update(Request $request)
    {
        $contactPage = ContactPage::query()->firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'page_badge' => ['nullable', 'string', 'max:255'],
            'page_title' => ['nullable', 'string', 'max:500'],
            'card_badge' => ['nullable', 'string', 'max:255'],
            'card_title' => ['nullable', 'string', 'max:255'],
            'card_description' => ['nullable', 'string'],
            'email_label' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'office_label' => ['nullable', 'string', 'max:255'],
            'office_address' => ['nullable', 'string'],
        ]);

        $contactPage->update($validated);

        return redirect()
            ->route('admin.contact_page.edit')
            ->with('success', 'Contact page updated successfully.');
    }
}
