<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([

            'comment' => 'required|max:1000',

        ]);

        $post->comments()->create([

            'user_id' => auth()->id(),

            'comment' => $request->comment,

        ]);

        return back()->with('success','Comment added.');
    }
}