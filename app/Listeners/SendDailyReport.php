<?php

namespace App\Listeners;

use App\Events\DailyAnswersThresholdReached;
use App\Mail\SurveyDailyReport;
use Illuminate\Support\Facades\Mail;

class SendDailyReport
{
    /**
     * Handle the event.
     *
     * @param DailyAnswersThresholdReached $event
     */
    public function handle(DailyAnswersThresholdReached $event): void
     {
        $survey = $event->survey;
        $user = $survey->user;
        
        if (!$user || !$user->email) {
            return;
        }

        Mail::raw(
            "Bonjour {$user->first_name},\n\n" .
            "Votre sondage \"{$survey->title}\" a reçu {$event->answersCount} réponses hier.\n\n" .
            "Voir les détails : " . route('survey.show', $survey->token) . "\n\nMerci, L'équipe",
            function ($message) use ($user, $survey) {
                $message->to($user->email)
                        ->subject("Rapport quotidien : {$survey->title}");
            }
        );
    }
}
