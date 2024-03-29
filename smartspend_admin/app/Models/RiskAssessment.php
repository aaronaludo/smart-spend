<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssessment extends Model
{
    use HasFactory;

    public function choices()
    {
        return $this->hasMany(RiskAssessmentChoice::class, 'risk_assessments_id');
    }
}
