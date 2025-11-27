<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SurveyClosed;
use Illuminate\Support\Facades\Mail;
use App\Mail\FinalSurveyReportMail;

class SendFinalReportOnClose
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
    public function handle(SurveyClosed $event)
    {
        $survey = $event->survey;

        if (!$survey->user || !$survey->user->email) {
            return;
        }

        $email = $survey->user->email;
        $subject = "Rapport final du sondage : {$survey->title}";

        $body = "Bonjour {$survey->user->first_name},\n\n";
        $body .= "Le sondage '{$survey->title}' est maintenant fermé.\n\n";
        $body .= "Résumé :\n";
        $body .= "Description : {$survey->description}\n";
        $body .= "Date de début : {$survey->start_date}\n";
        $body .= "Date de fin : {$survey->end_date}\n";
        $body .= "Nombre de réponses : " . $survey->answers()->count() . "\n\n";
        $body .= "Merci.\n";

        Mail::raw($body, function ($message) use ($email, $subject) {
            $message->to($email)
                    ->subject($subject);
        });
    }
}
