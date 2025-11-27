<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $table    = 'survey_questions';
    public $timestamps  = true;
    protected $fillable = [
        'id', 'survey_id',
        'title', 'question_type', 'options',
        'created_at', 'updated_at'
    ];
    protected $casts = [
        
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(SurveyAnswer::class);
    }
}
