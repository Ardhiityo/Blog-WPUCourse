<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with(['user:id,name,username', 'category:id,name,slug'])
            ->filter(
                [
                    'title' => $request->query('title') ?? false,
                    'username' => $request->query('username') ?? false,
                    'category' => $request->query('category') ?? false
                ]
            )
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        $title = 'Blogs';

        return view('pages.post.index', compact('posts', 'title'));
    }

    public function author(User $user)
    {
        $posts = $user->posts->load(['user:id,name,username', 'category:id,name,slug']);
        $title = $posts->count() . " Article by $user->name";

        return view('pages.post.index', compact('posts', 'title'));
    }

    public function category(Category $category)
    {
        $posts = $category->posts->load(['user:id,name,username', 'category:id,name,slug']);
        $title = "Article Category : $category->name";

        return view('pages.post.index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('pages.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
