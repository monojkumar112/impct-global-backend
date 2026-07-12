<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageUploadService
    ) {
    }

    public function index()
    {
        $services = Service::orderBy('sort_order')->latest()->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request, true);
        $validated['image'] = $this->imageUploadService->upload(
            $request->file('image'),
            'uploads/services'
        );
        $validated['status'] = $validated['status'] ?? 1;

        Service::create($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateService($request);

        if ($request->hasFile('image')) {
            $newImage = $this->imageUploadService->upload(
                $request->file('image'),
                'uploads/services'
            );
            $this->imageUploadService->delete($service->image);
            $validated['image'] = $newImage;
        }

        $validated['status'] = $validated['status'] ?? $service->status;
        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $this->imageUploadService->delete($service->image);
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    private function validateService(Request $request, bool $imageRequired = false): array
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
