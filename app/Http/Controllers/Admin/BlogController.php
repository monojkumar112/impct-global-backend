<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected ImageUploadService $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'author' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'custom_href' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:' . ImageUploadService::MAX_UPLOAD_KB,
            'status' => 'nullable|in:0,1',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $this->imageUploadService->upload(
                $request->file('image'),
                'uploads/blogs'
            );
        }

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        $slug = $this->makeUniqueSlug($slug);

        if (!empty($validated['content'])) {
            $validated['content'] = html_entity_decode($validated['content'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        Blog::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'author' => $validated['author'] ?? 'Impact Afrique Global Partners',
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'] ?? null,
            'custom_href' => $validated['custom_href'] ?? null,
            'image' => $imagePath,
            'status' => $validated['status'] ?? 1,
            'published_at' => $validated['published_at'] ?? now(),
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'author' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'custom_href' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:' . ImageUploadService::MAX_UPLOAD_KB,
            'status' => 'nullable|in:0,1',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $this->imageUploadService->delete($blog->image);
            $validated['image'] = $this->imageUploadService->upload(
                $request->file('image'),
                'uploads/blogs'
            );
        }

        if (!empty($validated['content'])) {
            $validated['content'] = html_entity_decode($validated['content'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        $slug = $this->makeUniqueSlug($slug, $blog->id);

        $blog->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'author' => $validated['author'] ?? $blog->author,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'] ?? $blog->content,
            'custom_href' => $validated['custom_href'] ?? null,
            'image' => $validated['image'] ?? $blog->image,
            'status' => $validated['status'] ?? $blog->status,
            'published_at' => $validated['published_at'] ?? $blog->published_at,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $this->imageUploadService->delete($blog->image);
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:' . ImageUploadService::MAX_UPLOAD_KB,
        ]);

        if (!$request->hasFile('upload')) {
            return response()->json(['uploaded' => 0]);
        }

        $path = $this->imageUploadService->upload(
            $request->file('upload'),
            'uploads/blogs'
        );

        return response()->json([
            'uploaded' => 1,
            'fileName' => basename($path),
            'url' => asset($path),
        ]);
    }

    protected function makeUniqueSlug(string $baseSlug, ?int $excludeId = null): string
    {
        $slug = Str::slug($baseSlug);
        $original = $slug;
        $i = 1;

        while (true) {
            $query = Blog::where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                return $slug;
            }

            $slug = $original . '-' . $i;
            $i++;
        }
    }
}
