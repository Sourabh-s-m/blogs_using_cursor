<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $blogs = Blog::with('user', 'category')->get();
        } else {
            $blogs = Blog::with('user', 'category')->where('user_id', Auth::id())->get();
        }
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate and create logic
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['user_id'] = Auth::id();

        Blog::create($validatedData);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        if (Auth::id() !== $blog->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('blogs.index')->with('error', 'Access denied.');
        }

        $categories = Category::all();
        return view('blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        if (Auth::id() !== $blog->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('blogs.index')->with('error', 'Access denied.');
        }

        // Validate the request data
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update the blog post
        $blog->update($validatedData);

        // Set the success message
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        try {
            $blog->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item deleted successfully!'
                ]);
            }

            return redirect()->back()->with('success', 'Item deleted successfully!');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete item.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to delete item.');
        }
    }
}
