<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyIndividualRequest extends Model
{
    protected $table = 'survey_individual_requests';

    protected $fillable = ['ip_address', 'count', 'blocked'];
}
