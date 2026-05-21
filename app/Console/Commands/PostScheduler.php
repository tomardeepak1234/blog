<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;
use App\Models\Post;
use App\Mail\NewPostMail;
use Illuminate\Support\Facades\Mail;

class PostScheduler extends Command
{
    protected $signature = 'post:scheduler';
    protected $description = 'Auto publish and archive posts';



// public function handle()
// {
//     $posts = Post::where('status', 'draft')
//         ->whereNotNull('publish_at')
//         ->where('publish_at', '<=', now())
//         ->get();
// // dd($posts);
//     foreach ($posts as $post) {

//         $post->update([
//             'status' => 'published',
//             'published_at' => now(),
//         ]);
//     }
// }

public function handle()
{

    $posts = Post::where('status', 'draft')
        ->whereNotNull('publish_at')
        ->where('publish_at', '<=', now())
        ->get();

    foreach ($posts as $post) {
            $post->status = 'published';
            $post->published_at = now();
            $post->save();
            
    }

    $posts = Post::where('status', 'published')
        ->where('email_sent', 0)
        ->with('user') //  admin user
        ->get();

    foreach ($posts as $post) {

        // Admin (jisne post banayi)
        $adminEmail = $post->user->email;

        // email send
        Mail::to($adminEmail)->send(new NewPostMail($post));

        //  duplicate रोकने के लिए
      $post->email_sent = 1;
        $post->save();
    }
}

// public function handle()
// {
//     // ✅ STEP 1: Publish posts
//     $draftPosts = Post::where('status', 'draft')
//         ->whereNotNull('publish_at')
//         ->where('publish_at', '<=', now())
//         ->get();

//     foreach ($draftPosts as $post) {
//         $post->update([
//             'status' => 'published',
//             'published_at' => now(),
//         ]);
//     }

//     // ✅ STEP 2: Send email
//     $publishedPosts = Post::where('status', 'published')
//         ->where('email_sent', 0)
//         ->with('user')
//         ->get();

//     foreach ($publishedPosts as $post) {

//         // 🔒 safe check
//         if (!$post->user || !$post->user->email) {
//             continue;
//         }

//         Mail::to($post->user->email)
//             ->send(new NewPostMail($post));

//         $post->update([
//             'email_sent' => 1
//         ]);
//     }
// }
}

