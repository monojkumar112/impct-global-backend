<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Controllers\Api\StaticContentSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Search across Blogs + Static Content.
     */
    public function search(Request $request)
    {
        $query = trim($request->get('q', ''));
        $language = $request->get('lang', 'en'); // bn or en

        if (empty($query) || mb_strlen($query, 'UTF-8') < 1) {
            return response()->json([
                'blogs' => [],
                'all' => [],
                'total' => 0,
            ], 200);
        }

        // Clean query - preserve original for display but use for search
        $originalQuery = $query;
        
        // Split query into words for better search
        $searchWords = preg_split('/\s+/', $query);
        $searchWords = array_filter($searchWords, function($word) {
            return mb_strlen(trim($word), 'UTF-8') > 0;
        });
        
        // If no words after filtering, use original query
        if (empty($searchWords)) {
            $searchWords = [$query];
        }

        // Search in Blogs
        $blogs = $this->searchBlogs($searchWords, $query);
        
        // Search in Static Content
        $staticContent = StaticContentSearch::search($query, $language);

        // Merge all results and sort by relevance (title matches first, then by date)
        $allResults = collect($blogs)
            ->merge($staticContent)
            ->sortByDesc(function($item) {
                // Sort by relevance score (if exists) or created_at
                return $item['relevance_score'] ?? strtotime($item['created_at']);
            })
            ->take(50)
            ->values()
            ->map(function($item) {
                unset($item['relevance_score']);
                return $item;
            });

        return response()->json([
            'blogs' => $blogs,
            'static_content' => $staticContent,
            'all' => $allResults,
            'total' => count($blogs) + count($staticContent),
            'query' => $query,
        ], 200);
    }

    /**
     * Search in Blogs with relevance scoring
     */
    private function searchBlogs($searchWords, $fullQuery)
    {
        $query = Blog::where('status', 1);

        $query->where(function($q) use ($searchWords, $fullQuery) {
            $q->where('title', 'LIKE', '%' . $fullQuery . '%')
              ->orWhere('excerpt', 'LIKE', '%' . $fullQuery . '%')
              ->orWhere('content', 'LIKE', '%' . $fullQuery . '%');

            foreach ($searchWords as $word) {
                $q->orWhere('title', 'LIKE', '%' . $word . '%')
                  ->orWhere('excerpt', 'LIKE', '%' . $word . '%')
                  ->orWhere('content', 'LIKE', '%' . $word . '%');
            }
        });

        return $query->latest('published_at')->latest()->limit(20)->get()->map(function($item) use ($fullQuery) {
            $title = $item->title;
            $description = $item->excerpt ?: substr(strip_tags($item->content ?? ''), 0, 150);

            // Calculate relevance score (title matches score higher)
            $relevanceScore = 0;
            if (stripos($title, $fullQuery) !== false) {
                $relevanceScore += 100;
            }
            if (stripos($title, $fullQuery) === 0) {
                $relevanceScore += 50;
            }
            foreach (explode(' ', $fullQuery) as $word) {
                if (stripos($title, $word) !== false) {
                    $relevanceScore += 10;
                }
            }

            return [
                'id' => $item->id,
                'type' => 'blog',
                'title' => $title,
                'description' => $description,
                'slug' => $item->slug,
                'image' => $item->image ? asset($item->image) : null,
                'url' => '/blogs/' . $item->slug,
                'created_at' => $item->published_at ?? $item->updated_at,
                'relevance_score' => $relevanceScore,
            ];
        })->toArray();
    }
}

