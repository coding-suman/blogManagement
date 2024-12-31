<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::paginate(perPage: 10);
        return view('blog.blogs', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'content' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('blogs', 'public');

        // Create the blog
        $blog = Blog::create([
            'title' => $validated['title'],
            'image' => $imagePath,
            'content' => $validated['content'],
            'tags' => $validated['tags'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('myblogs', $blog->id)->with('success', 'Blog created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blog.view', compact('blog'));
    }

    public function myBlog(string $id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blog.viewMyBlog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.add', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'content' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
            if ($blog->image) {
                Storage::delete('public/' . $blog->image);
            }
            $blog->image = $imagePath;
        }

        $blog->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'tags' => $validated['tags'],
        ]);

        return redirect()->route('blog.show', $blog->id)->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image) {
            Storage::delete('public/' . $blog->image);
        }

        $blog->delete();
        return redirect()->route('myblogs')->with('success', 'Blog deleted successfully');
    }

}
