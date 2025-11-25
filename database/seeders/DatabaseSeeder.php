<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Survey;
use App\Models\Organization;
use App\Models\SurveyAnswer;
use App\Models\SurveyQuestion;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. User
        $user = User::create([
            'last_name'  => 'Doe',
            'first_name' => 'John',
            'email'      => 'test@feedflow.local',
            'password'   => bcrypt('password'),
        ]);

        // 2. Organization
        $organization = Organization::create([
            'name'       => 'Acme Corporation',
            'user_id'    => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Survey
        $survey = Survey::create([
            'organization_id' => $organization->id,
            'user_id'         => $user->id,
            'title'           => 'Customer Satisfaction Survey',
            'description'     => 'A survey to gauge customer satisfaction levels.',
            'start_date'      => now(),
            'end_date'        => now()->addMonth(),
            'is_anonymous'    => false,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        DB::table('survey_questions')->insert([
            'survey_id'   => $survey->id,
            'title'       => 'test',
            'question_type' => 'text',
            'options'     => json_encode([
                'question1' => 'vert',
                'question2' => 'blue',
                'question3' => 'jaune',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('survey_answers')->insert([
            'survey_id' => $survey->id,
            'survey_question_id' => 1,
            'user_id' => 1,
            'answer' => 'vert',
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);
    }
}
