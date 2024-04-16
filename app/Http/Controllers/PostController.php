<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_post' => ['required'],
            'slug' => ['required'],
            'gambar' => ['required'],
        ]);

        return Post::create($data);
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'judul_post' => ['required'],
            'slug' => ['required'],
            'gambar' => ['required'],
        ]);

        $post->update($data);

        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json();
    }
}
