<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HowWeWork;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class HowWeWorkController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageUploadService
    ) {
    }

    public function index()
    {
        $items = HowWeWork::orderBy('sort_order')->latest()->get();

        return view('admin.how_we_works.index', compact('items'));
    }

    public function create()
    {
        return view('admin.how_we_works.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateItem($request, true);
        $validated['image'] = $this->imageUploadService->upload(
            $request->file('image'),
            'uploads/how-we-work'
        );
        $validated['status'] = $validated['status'] ?? 1;

        HowWeWork::create($validated);

        return redirect()
            ->route('admin.how_we_works.index')
            ->with('success', 'How We Work item created successfully.');
    }

    public function edit(HowWeWork $howWeWork)
    {
        return view('admin.how_we_works.edit', compact('howWeWork'));
    }

    public function update(Request $request, HowWeWork $howWeWork)
    {
        $validated = $this->validateItem($request);

        if ($request->hasFile('image')) {
            $newImage = $this->imageUploadService->upload(
                $request->file('image'),
                'uploads/how-we-work'
            );
            $this->imageUploadService->delete($howWeWork->image);
            $validated['image'] = $newImage;
        }

        $validated['status'] = $validated['status'] ?? $howWeWork->status;
        $howWeWork->update($validated);

        return redirect()
            ->route('admin.how_we_works.index')
            ->with('success', 'How We Work item updated successfully.');
    }

    public function destroy(HowWeWork $howWeWork)
    {
        $this->imageUploadService->delete($howWeWork->image);
        $howWeWork->delete();

        return redirect()
            ->route('admin.how_we_works.index')
            ->with('success', 'How We Work item deleted successfully.');
    }

    private function validateItem(Request $request, bool $imageRequired = false): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => ($imageRequired ? 'required' : 'nullable')
                . '|image|mimes:jpeg,png,jpg,gif,webp|max:'
                . ImageUploadService::MAX_UPLOAD_KB,
            'sort_order' => 'required|integer|min:0',
            'status' => 'nullable|in:0,1',
        ]);
    }
}
