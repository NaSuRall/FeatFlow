<?php

namespace Tests\Unit;

use App\Actions\Survey\StoreSurveyAction;
use App\DTOs\SurveyDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class StoreSurveyActionTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    use RefreshDatabase;
    public function storeSurveyActionTest(): void
    {
        $dto = SurveyDTO::fromRequest([
            'organization_id' => 1,
            'user_id' => 1,
            'title' => 'test 1',
            'description' => 'ceci est le test 1',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'is_anonymous' => false,
        ]);


        $action = new StoreSurveyAction();
        $article = $action->execute($dto);

        $this->assertInstanceOf(Survey::class, $article);
        $this->assertDatabaseHas('surveys', [
            'organization_id' => 1,
            'user_id' => 1,
            'title' => 'test 1',
            'description' => 'ceci est le test 1',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'is_anonymous' => false
        ]);
    }
}
