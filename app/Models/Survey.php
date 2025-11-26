<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Survey extends Model
{
    use HasFactory;

    protected $table    = 'surveys';
    public $timestamps  = true;
    protected $fillable = [
        'id', 'token', 'organization_id', 'user_id',
        'title', 'description', 'start_date', 'end_date', 'is_anonymous',
        'created_at', 'updated_at'
    ];
    protected $casts = [
    ];

   /* public function organization(): HasOne
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }*/


    function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, 'survey_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
