<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageUploadService
    ) {
    }

    public function edit()
    {
        $homePage = HomePage::query()->firstOrCreate(['id' => 1]);

        return view('admin.home_page.edit', compact('homePage'));
    }

    public function update(Request $request)
    {
        $homePage = HomePage::query()->firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'hero_badge' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'hero_tagline' => ['nullable', 'string', 'max:255'],
            'hero_primary_btn_text' => ['nullable', 'string', 'max:255'],
            'hero_primary_btn_link' => ['nullable', 'string', 'max:255'],
            'hero_secondary_btn_text' => ['nullable', 'string', 'max:255'],
            'hero_secondary_btn_link' => ['nullable', 'string', 'max:255'],
            'hero_map_label' => ['nullable', 'string', 'max:255'],
            'hero_priorities' => ['nullable', 'array', 'max:10'],
            'hero_priorities.*.label' => ['required_with:hero_priorities', 'string', 'max:255'],
            'hero_priorities.*.value' => ['required_with:hero_priorities', 'string', 'max:255'],
            'hero_image' => ['nullable', 'image', 'max:' . ImageUploadService::MAX_UPLOAD_KB],
            'who_title' => ['nullable', 'string', 'max:255'],
            'who_description' => ['nullable', 'string'],
            'who_btn_text' => ['nullable', 'string', 'max:255'],
            'who_btn_link' => ['nullable', 'string', 'max:255'],
            'who_image' => ['nullable', 'image', 'max:' . ImageUploadService::MAX_UPLOAD_KB],
            'story_label' => ['nullable', 'string', 'max:255'],
            'story_title' => ['nullable', 'string', 'max:500'],
            'story_description' => ['nullable', 'string'],
            'story_features' => ['nullable', 'array', 'max:6'],
            'story_features.*.icon' => ['required_with:story_features', 'string', 'max:50'],
            'story_features.*.title' => ['required_with:story_features', 'string', 'max:255'],
            'story_features.*.description' => ['required_with:story_features', 'string'],
            'story_btn_text' => ['nullable', 'string', 'max:255'],
            'story_btn_link' => ['nullable', 'string', 'max:255'],
            'story_image' => ['nullable', 'image', 'max:' . ImageUploadService::MAX_UPLOAD_KB],
            'story_quote' => ['nullable', 'string'],
            'story_quote_author' => ['nullable', 'string', 'max:255'],
            'why_title' => ['nullable', 'string', 'max:255'],
            'why_description' => ['nullable', 'string'],
            'why_items' => ['nullable', 'array', 'max:8'],
            'why_items.*.num' => ['required_with:why_items', 'string', 'max:10'],
            'why_items.*.title' => ['required_with:why_items', 'string', 'max:255'],
            'why_items.*.description' => ['required_with:why_items', 'string'],
            'join_badge' => ['nullable', 'string', 'max:255'],
            'join_title' => ['nullable', 'string', 'max:500'],
            'join_description' => ['nullable', 'string'],
            'join_primary_btn_text' => ['nullable', 'string', 'max:255'],
            'join_primary_btn_link' => ['nullable', 'string', 'max:255'],
            'join_secondary_btn_text' => ['nullable', 'string', 'max:255'],
            'join_secondary_btn_link' => ['nullable', 'string', 'max:255'],
        ]);

        foreach (['hero_image', 'who_image', 'story_image'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $this->imageUploadService->delete($homePage->{$imageField});
                $validated[$imageField] = $this->imageUploadService->upload(
                    $request->file($imageField),
                    'uploads/home'
                );
            } else {
                unset($validated[$imageField]);
            }
        }

        $validated['hero_priorities'] = array_values($validated['hero_priorities'] ?? []);
        $validated['story_features'] = array_values($validated['story_features'] ?? []);
        $validated['why_items'] = array_values($validated['why_items'] ?? []);

        $homePage->update($validated);

        return redirect()
            ->route('admin.home_page.edit')
            ->with('success', 'Home page updated successfully.');
    }
}
