<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicSurveyLinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function public_survey_route_is_accessible()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/survey/test-token');

        $response->assertStatus(200);
        $response->assertSee('Titre du sondage');
    }
}
