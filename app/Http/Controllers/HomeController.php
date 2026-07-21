<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $featured = Post::with(['user', 'category'])
            ->where('status', 'published')
            ->latest()
            ->first();

        $posts = Post::with(['user', 'category'])
            ->where('status', 'published')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('content', 'like', '%' . $request->search . '%');
                });
            })
            ->when($featured, function ($query) use ($featured) {
                $query->where('id', '!=', $featured->id);
            })
            ->latest()
            ->paginate(6);

        $categories = Category::orderBy('name')->get();

        return view('welcome', compact(
            'featured',
            'posts',
            'categories'
        ));
    }

    public function show(Post $post)
    {
        $post->load('user','category','comments.user', 'likes');
        $post->increment('views');

        $related = Post::where('category_id', $post->category_id)
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('post', compact(
            'post',
            'related'
        ));
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(6);

        $categories = Category::all();

        return view('category', compact(
            'posts',
            'categories',
            'category'
        ));
    }
}