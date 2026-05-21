<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    // List Posts
    public function index(Request $request)
    {
        $authUser = auth()->user();

        $posts = Post::with('user');

        if ($authUser->role->name != 'Admin') {
            $posts->where('user_id', $authUser->id);
        }

        if ($request->search) {
            $posts->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $posts->latest()->paginate(2);

        return view('post.list', compact('posts'));
    }

    // Home Page
    public function home(Request $request)
    {
        $user = auth()->user();

        $query = Post::with([
            'user',
            'likes',
            'comments.user',
            'comments.likes',
            'comments.replies.user',
            'comments.replies.likes'
        ])
        ->withCount(['likes','comments'])
        ->where('status', 'published');

        if ($user->role->name == 'Admin') {
            $query;
        }else {
            $query->where('state_id', $user->state_id);
        }

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest()->get();

        return view('home', compact('posts'));
    }

    // My Posts
    public function MyPost()
    {
        $id = Auth::user()->id;
        $posts = Post::with('user')->where('user_id', $id)->get();

        return view('my_posts', compact('posts'));
    }

    // Create Post
    public function create()
    {
        $user = Auth::user();
        return view('post.index', compact('user'));
    }

    // Store Post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'publish_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = Auth::id();
        $post->state_id = Auth::user()->state_id;
        $post->publish_at = $request->publish_at;

        // dd($request->all());


        if (!$request->publish_at) {
            $post->status = 'published';
        } elseif ($request->publish_at <= now()) {
            $post->status = 'published';
        } else {
            $post->status = 'draft';
        }

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully');
    }

    // Edit Post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    // Update Post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'publish_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->publish_at = $request->publish_at;

        if (!$request->publish_at) {
            $post->status = 'published';
        } elseif ($request->publish_at <= now()) {
            $post->status = 'published';
        } else {
            $post->status = 'draft';
        }

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    // Delete Post
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }

    // Unpublish → Draft
    public function unpublish($id)
    {
        $post = Post::findOrFail($id);

        $post->status = 'draft';
        $post->save();

        return back()->with('success', 'Post moved to draft');
    }

}







