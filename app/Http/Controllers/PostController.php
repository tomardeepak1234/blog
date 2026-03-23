<?php

    namespace App\Http\Controllers;

    use App\Models\Post;
    use App\Models\Comment;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\CommentLikes;
use App\Models\Role;
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
            // $user= $request->user();
            // dd($user);

    $query = Post::with([
        'user',
        'likes',
        'comments.user',
        'comments.likes',
        'comments.replies.user',
        'comments.replies.likes'
    ])->withCount(['likes','comments'])->where('is_published', true);

            if ($user) {
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
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                'is_published' => 'required|in:0,1',
            ]);

            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = Auth::id();
            $post->state_id = Auth::user()->state_id;
            $post->is_published = $request->is_published;

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
    'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
    'is_published' => 'required|in:0,1',
]);

            $post->title = $request->title;
            $post->description = $request->description;
            $post->is_published = $request->is_published;

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

        // Like Post
        public function likePost(Post $post)
        {
            $user = auth()->user();


            if (!$post->likes()->where('user_id', $user->id)->exists()) {
                $post->likes()->create(['user_id' => $user->id]);
            }

            return back();
        }
        // Comment on Post

        public function commentPost(Request $request, Post $post)
        {
            $request->validate([
                'comment' => 'required|string|max:500',
            ]);

            $post->comments()->create([
                'user_id' => auth()->id(),
                'comment' => $request->comment,
                'parent_id' => null
            ]);

            return back();
        }

        // Publish Post

        public function unpublish($id)
        {
            $post = Post::findOrFail($id);

            $post->is_published = false;
            $post->save();

            return back()->with('success', 'Post unpublished successfully');
        }

    // Reply to Comment

        public function replyComment(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id'   => auth()->id(),
            'post_id'   => $comment->post_id,
            'parent_id' => $comment->id,
            'comment'   => $request->comment,
        ]);

        return back();
    }

    // Like Comment

    public function likeComment(Comment $comment)
    {
        $user = auth()->user();

        $like = $comment->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
        } else {
            $comment->likes()->create([
                'user_id' => $user->id
            ]);
        }

        return back();
    }

    }
