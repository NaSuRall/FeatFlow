<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Survey;
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
        // User::factory(10)->create();

        $user = User::firstOrCreate([
            'email' => 'test@feedflow.local',
        ],[
            'last_name'  => 'Doe',
            'first_name' => 'John',
            'password'   => bcrypt('password'),
        ]);

        $user = User::firstOrCreate([
            'email' => 'michael@feedflow.joly',
        ],[
            'last_name'  => 'Joly',
            'first_name' => 'Michael',
            'password'   => bcrypt('password'),
        ]);

        $user = User::firstOrCreate([
            'email' => 'delphine@feedflow.garnier',
        ],[
            'last_name'  => 'Garnier',
            'first_name' => 'Delphine',
            'password'   => bcrypt('password'),
        ]);


        // 2. Organization
        $organization = Organization::firstOrCreate([
            'name'       => 'Acme Corporation',
            ],[
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

        // 4. Questions
        DB::table('survey_questions')->insert([
            'survey_id'   => $survey->id,
            'title'       => 'Question 1',
            'question_type' => 'text',
            'options'     => json_encode([
                'question1' => 'réponse 1',
                'question2' => 'réponse 2',
                'question3' => 'réponse 3',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('survey_questions')->insert([
            [
                'survey_id'    => $survey->id,
                'title'        => 'Question 2',
                'question_type'=> 'radio',
                'options'      => json_encode([
                    'réponse 1',
                    'réponse 2',
                    'réponse 3',
                ]),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'survey_id'    => $survey->id,
                'title'        => 'Question 3',
                'question_type'=> 'checkbox',
                'options'      => json_encode([
                    'réponse 1',
                    'réponse 2',
                    'réponse 3',
                ]),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);

        // 4. Answers
        DB::table('survey_answers')->insert([
            'survey_id' => $survey->id,
            'survey_question_id' => 1,
            'user_id' => 1,
            'answer' => 'réponse 1',
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);


        DB::table('survey_answers')->insert([
            // Question 1 (text) existante
            [
                'survey_id'            => $survey->id,
                'survey_question_id'   => 1,
                'user_id'              => 2,
                'answer'               => 'réponse 2',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            // Question 2 (radio)
            [
                'survey_id'            => $survey->id,
                'survey_question_id'   => 2,
                'user_id'              => 1,
                'answer'               => 'réponse 1',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'survey_id'            => $survey->id,
                'survey_question_id'   => 2,
                'user_id'              => null, // anonyme
                'answer'               => 'réponse 3',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            // Question 3 (checkbox)
            [
                'survey_id'            => $survey->id,
                'survey_question_id'   => 3,
                'user_id'              => 2,
                'answer'               => 'réponse 1,réponse 2',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
            [
                'survey_id'            => $survey->id,
                'survey_question_id'   => 3,
                'user_id'              => 3,
                'answer'               => 'réponse 2,réponse 3',
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
        ]);

    }
}
