<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;

final class UpdateSurveyAction
{
    public function __construct() {}

    /**
     * Update a Survey
     * @param SurveyDTO $dto
     * @return array
     */
    public function handle(SurveyDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
        });
    }

    public function execute(SurveyDTO $dto, $survey): Survey{
        $survey->title = $dto->title;
        $survey->description = $dto->description;
        $survey->start_date = $dto->start_date;
        $survey->end_date = $dto->end_date;
        $survey->is_anonymous = $dto->is_anonymous;
        $survey->save();
        return $survey;
    }
}
