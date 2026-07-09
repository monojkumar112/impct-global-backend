<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', true)
            ->latest('published_at')
            ->latest()
            ->get()
            ->map(fn (Blog $blog) => $blog->toApiArray());

        return response()->json($blogs, 200);
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', true)->first();

        if (!$blog) {
            return response()->json([
                'message' => 'Blog not found',
            ], 404);
        }

        return response()->json($blog->toApiArray(), 200);
    }

    public function recent(string $slug)
    {
        $blogs = Blog::where('status', true)
            ->where('slug', '!=', $slug)
            ->latest('published_at')
            ->latest()
            ->limit(10)
            ->get()
            ->map(fn (Blog $blog) => $blog->toApiArray());

        return response()->json($blogs, 200);
    }
}
