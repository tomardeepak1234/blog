<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Login;
use App\Models\User;

class SendLoginWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;
       if ($user->login_count == 1) {
        Mail::to($user->email)
            ->send(new WelcomeMail($user));
      }
    }
}
