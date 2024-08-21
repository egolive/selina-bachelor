<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyRequested extends Model
{
    protected $table = 'survey_requested';

    protected $fillable = ['count'];
}
