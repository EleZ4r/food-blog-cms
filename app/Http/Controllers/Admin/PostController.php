<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user','category'])
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'excerpt'=>'nullable|max:500',
            'content'=>'required',
            'featured_image'=>'nullable|image|max:2048',
            'category_id'=>'required|exists:categories,id',
            'status'=>'required'
        ]);

        $image = null;

        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image')
                ->store('posts','public');
        }

        Post::create([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title.'-'.time()),
            'excerpt'=>$request->excerpt,
            'content'=>$request->content,
            'featured_image'=>$image,
            'status'=>$request->status,
            'user_id'=>auth()->id(),
            'category_id'=>$request->category_id,
            'approved_by'=>$request->status=='published'
                ? auth()->id()
                : null,
            'published_at'=>$request->status=='published'
                ? now()
                : null,
        ]);

        return redirect()
            ->route('admin.posts.index')
            ->with('success','Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.edit', compact('post','categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|max:255',
            'excerpt'=>'nullable|max:500',
            'content'=>'required',
            'featured_image'=>'nullable|image|max:2048',
            'category_id'=>'required|exists:categories,id',
            'status'=>'required'
        ]);

        $image = $post->featured_image;

        if($request->hasFile('featured_image')){

            if($post->featured_image){
                Storage::disk('public')->delete($post->featured_image);
            }

            $image = $request->file('featured_image')
                ->store('posts','public');
        }

        $post->update([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title.'-'.time()),
            'excerpt'=>$request->excerpt,
            'content'=>$request->content,
            'featured_image'=>$image,
            'status'=>$request->status,
            'category_id'=>$request->category_id,
            'approved_by'=>$request->status=='published'
                ? auth()->id()
                : null,
            'published_at'=>$request->status=='published'
                ? now()
                : null,
        ]);

        return redirect()
            ->route('admin.posts.index')
            ->with('success','Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if($post->featured_image){
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return back()->with('success','Post deleted successfully.');
    }
    public function approve(Post $post)
    {
        $post->update([

            'status' => 'published',

            'approved_by' => auth()->id(),

            'published_at' => now(),

        ]);

        return back()->with(
            'success',
            'Post approved successfully.'
        );
    }

    public function reject(Post $post)
    {
        $post->update([

            'status' => 'rejected',

            'approved_by' => null,

            'published_at' => null,

        ]);

        return back()->with(
            'success',
            'Post rejected.'
        );
    }
}