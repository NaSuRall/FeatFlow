<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class StoreSurveyAction
{
    public function __construct() {}

    /**
     * Store a Survey
     * @param SurveyDTO $dto
     * @return array
     */
    public function handle(SurveyDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
        });
    }

    public function execute(SurveyDTO $dto): Survey{

        //create un survey in db
        $survey = Survey::create([
            'organization_id' => $dto->organization_id,
            'user_id' => $dto->user_id,
            'title' => $dto->title,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
            'is_anonymous' => $dto->is_anonymous,
            'token' => Str::uuid()->toString(),
        ]);

        return $survey;
    }
}
