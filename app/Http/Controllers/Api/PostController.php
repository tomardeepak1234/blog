<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //  GET ALL POSTS
    public function index()
    {
        $posts = Post::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $posts
        ]);
    }

    //  CREATE POST
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
        $post->user_id = auth()->id();
        $post->state_id = $request->state_id;
        $post->publish_at = $request->publish_at;

        // AUTO STATUS LOGIC

        if (!$request->publish_at) {

            $post->status = 'published';

        } elseif ($request->publish_at <= now()) {

            $post->status = 'published';

        } else {

            $post->status = 'draft';
        }

        // IMAGE UPLOAD

        if ($request->hasFile('image')) {

            $post->image = $request->file('image')
                ->store('posts', 'public');
        }

        $post->save();

        return response()->json([

            'status' => true,
            'message' => 'Post Created Successfully',
            'data' => $post

        ]);
    }

    public function update(Request $request, $id)
{
    $post = Post::find($id);

    if (!$post) {

        return response()->json([
            'status' => false,
            'message' => 'Post not found'
        ], 404);
    }

    // VALIDATION

    $request->validate([

        'title' => 'required',

        'description' => 'required',

        'state_id' => 'required',

        'publish_at' => 'nullable|date',

        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
    ]);

    // UPDATE DATA

    $post->title = $request->title;

    $post->description = $request->description;
    // $post->user_id = auth()->id();
    $post->state_id = $request->state_id;

    $post->publish_at = $request->publish_at;

    // STATUS LOGIC

    if (!$request->publish_at) {

        $post->status = 'published';

    } elseif ($request->publish_at <= now()) {

        $post->status = 'published';

    } else {

        $post->status = 'draft';
    }

    // IMAGE UPDATE

    if ($request->hasFile('image')) {

        $post->image = $request->file('image')
            ->store('posts', 'public');
    }

    $post->save();

    return response()->json([

        'status' => true,

        'message' => 'Post updated successfully',

        'data' => $post
    ]);
}
    //  SINGLE POST
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $post
        ]);
    }


    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found'
            ], 404);
        }


        $post->delete();

        return response()->json([
            'status' => true,
            'message' => 'Post deleted'
        ]);
    }
}
