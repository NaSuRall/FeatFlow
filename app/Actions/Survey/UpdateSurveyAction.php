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
        if ($dto->title !== null) {
            $survey->title = $dto->title;
        }
        if ($dto->description !== null) {
            $survey->description = $dto->description;
        }
        if ($dto->start_date !== null) {
            $survey->start_date = $dto->start_date;
        }
        if ($dto->end_date !== null) {
            $survey->end_date = $dto->end_date;
        }
        if ($dto->is_anonymous !== null) {
            $survey->is_anonymous = $dto->is_anonymous;
        }

        $survey->save();
        return $survey;
    }
}
