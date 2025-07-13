<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query('keyword');

        $posts = Post::with(['user:id,name', 'category:id,name'])
            ->where('user_id', Auth::user()->id)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%");
            })
            ->select('id', 'title', 'slug', 'category_id', 'user_id', 'body', 'created_at')
            ->paginate(8)
            ->withQueryString();

        return view('pages.dashboard.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:25|min:3',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string|min:3',
        ]);

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'body' => $request->body,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('pages.dashboard.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('pages.dashboard.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25|min:3|unique:posts,title,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string|min:3',
        ]);

        $post->update($validated);

        return redirect()->route('dashboard.index')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('dashboard.index')->with('success', 'Post has been deleted');
    }
}
