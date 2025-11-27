<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Survey;
use App\Events\SurveyClosed;
use Carbon\Carbon;

class CheckForSurveyToClose extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-for-survey-to-close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ferme les sondages dont la date de fin est atteinte';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $surveysToClose = Survey::whereDate('end_date', '<=', $today)
                                ->where('status', 'open')
                                ->get();

        foreach ($surveysToClose as $survey) {
            $survey->update(['status' => 'closed']);

            SurveyClosed::dispatch($survey);

            $this->info("Sondage '{$survey->title}' fermé et événement déclenché.");
        }
    }
}
