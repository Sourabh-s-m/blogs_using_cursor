<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // Get blogs with filters
        $query = Blog::with(['user', 'category'])
                     ->latest();

        // Apply category filter
        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        // Apply search filter
        if (request('search')) {
            $searchTerm = request('search');
            $query->where('title', 'LIKE', "%{$searchTerm}%");
        }

        // Get paginated results
        $blogs = $query->paginate(9)->withQueryString();

        // Get all categories for dropdown
        $categories = Category::orderBy('name')->get();

        return view('welcome', compact('blogs', 'categories'));
    }

    public function show(Blog $blog)
    {
        // Load the relationships
        $blog->load(['user', 'category']);

        // Get related blogs from same category
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        return view('blogview', compact('blog', 'relatedBlogs'));
    }

    public function categoryBlogs(Category $category)
    {
        $blogs = Blog::with(['user', 'category'])
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(9);

        $categories = Category::withCount('blogs')
            ->get();

        return view('welcome', [
            'blogs' => $blogs,
            'categories' => $categories,
            'currentCategory' => $category
        ]);
    }
}
