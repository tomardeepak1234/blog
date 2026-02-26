<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    public function index(Request $request)
    {
        $authUser = auth()->user();
        $posts = Post::with('user');

        if($authUser->role->name !='Admin') {
            $posts->where('user_id', $authUser->id);
        }

        $posts = $posts->latest()->get();

        return view('post.list', compact('posts'));

    }

    public function home(Request $request)
    {
        
        $user = auth()->user();

       $query = Post::with(['user','likes','comments']);

      if ($user) {
        $query->where('state_id', $user->state_id);
      }

    if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

         $posts = $query->latest()->get();
        return view('home', compact('posts'));
        }

    public function MyPost()
    {
        $id = Auth::user()->id;
        $posts = Post::with('user')->where('user_id', $id)->get();

        return view('my_posts', compact('posts'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('post.index', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = Auth::id();


        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $user=Auth::user();
        return view('post.edit', compact('post','user'));
    }


    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }


    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }

  
    public function likePost(Post $post)
    {
        $user = auth()->user();

        // check if already liked
        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->create(['user_id' => $user->id]);
        }

        return back();
    }

    public function commentPost(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back();
    }
}
