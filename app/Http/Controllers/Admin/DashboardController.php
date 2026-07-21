<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [

            'users' => User::count(),

            'categories' => Category::count(),

            'posts' => Post::count(),

            'published' => Post::where('status', 'published')->count(),

            'pending' => Post::where('status', 'pending')->count(),

            'drafts' => Post::where('status', 'draft')->count(),

            'recentPosts' => Post::with('user')
                ->latest()
                ->take(5)
                ->get(),

        ]);
    }
}