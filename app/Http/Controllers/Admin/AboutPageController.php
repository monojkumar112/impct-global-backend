<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageUploadService
    ) {
    }

    public function edit()
    {
        $aboutPage = AboutPage::query()->firstOrCreate(['id' => 1]);

        return view('admin.about_page.edit', compact('aboutPage'));
    }

    public function update(Request $request)
    {
        $aboutPage = AboutPage::query()->firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_paragraphs' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'max:' . ImageUploadService::MAX_UPLOAD_KB],
        ]);

        if ($request->hasFile('hero_image')) {
            $this->imageUploadService->delete($aboutPage->hero_image);
            $validated['hero_image'] = $this->imageUploadService->upload(
                $request->file('hero_image'),
                'uploads/about'
            );
        } else {
            unset($validated['hero_image']);
        }

        $aboutPage->update($validated);

        return redirect()
            ->route('admin.about_page.edit')
            ->with('success', 'About page updated successfully.');
    }
}
