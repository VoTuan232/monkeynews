<?php

namespace App\Listeners;

use App\Events\NewPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\CreateNewPost;
use Auth;
use Mail;
use App\Models\User;

class SendEmailAfterNewPost
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewPost  $event
     * @return void
     */
    public function handle(NewPost $event)
    {
        $email = new CreateNewPost(Auth::user(), $post);
        Mail::to(Auth::user()->email)->send($email);
    }
}
