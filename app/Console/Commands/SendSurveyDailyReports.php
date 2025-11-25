<?php

namespace App\Console\Commands;

use App\Models\Survey;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Events\DailyAnswersThresholdReached;


class SendSurveyDailyReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-survey-daily-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoie un rapport quotidien aux créateurs de sondage si plus de 10 réponses la veille';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $yesterday = Carbon::yesterday()->startOfDay();

        $surveys = Survey::with(['user'])
            ->withCount(['answers' => function ($query) use ($yesterday) {
                $query->whereBetween('created_at', [$yesterday, $yesterday->copy()->endOfDay()]);
            }])
            ->get();

        foreach ($surveys as $survey) {
            $answersCount = $survey->answers()
                ->whereBetween('created_at', [$yesterday, $yesterday->copy()->endOfDay()])
                ->count();
            
            if ($answersCount >= 10) {
                event(new DailyAnswersThresholdReached($survey, $answersCount));
            }
        }

        $this->info('Rapports quotidiens envoyés.');
    }
}

