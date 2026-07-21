<?php

namespace App\Http\Controllers\Composer;

use App\Http\Controllers\Controller;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('composer.dashboard', [

            'totalPosts' => Post::where('user_id', $user->id)->count(),

            'drafts' => Post::where('user_id', $user->id)
                ->where('status', 'draft')
                ->count(),

            'pending' => Post::where('user_id', $user->id)
                ->where('status', 'pending')
                ->count(),

            'published' => Post::where('user_id', $user->id)
                ->where('status', 'published')
                ->count(),

            'rejected' => Post::where('user_id', $user->id)
                ->where('status', 'rejected')
                ->count(),

            'recentPosts' => Post::where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get(),

        ]);
    }
}