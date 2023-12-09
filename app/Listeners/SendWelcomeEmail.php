<?php

namespace App\Listeners;

use App\Events\NewUserRegister;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\EmailVerifiedMail;
use Illuminate\Support\Facades\Mail;
class SendWelcomeEmail
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
    public function handle(NewUserRegister $event): void
    {
        $userId = $event->userId;
        $user = User::find($userId);
        Mail::to($user->email)->send(new EmailVerifiedMail($user));

    }
}
