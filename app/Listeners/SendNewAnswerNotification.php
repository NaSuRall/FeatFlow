<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\SurveyAnswerSubmitted;

class SendNewAnswerNotification
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
    public function handle(SurveyAnswerSubmitted $event): void
    {
       Mail::raw('Nouvel reponse sondage ', function ($message) {
            $message->to('admin@example.com')
                    ->subject('Sujet du mail');
        });
    }
}
