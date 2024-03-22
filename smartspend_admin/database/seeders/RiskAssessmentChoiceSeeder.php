<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RiskAssessmentChoice;
class RiskAssessmentChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RiskAssessmentChoice::create([
            'id' => 1,
            'risk_assessments_id' => 1,
            'letter' => 'a',
            'description' => 'True'
        ]);
        RiskAssessmentChoice::create([
            'id' => 2,
            'risk_assessments_id' => 1,
            'letter' => 'b',
            'description' => 'False'
        ]);
        RiskAssessmentChoice::create([
            'id' => 3,
            'risk_assessments_id' => 2,
            'letter' => 'a',
            'description' => 'True'
        ]);
        RiskAssessmentChoice::create([
            'id' => 4,
            'risk_assessments_id' => 2,
            'letter' => 'b',
            'description' => 'False'
        ]);
        RiskAssessmentChoice::create([
            'id' => 5,
            'risk_assessments_id' => 3,
            'letter' => 'a',
            'description' => 'True'
        ]);
        RiskAssessmentChoice::create([
            'id' => 6,
            'risk_assessments_id' => 3,
            'letter' => 'b',
            'description' => 'False'
        ]);
        RiskAssessmentChoice::create([
            'id' => 7,
            'risk_assessments_id' => 4,
            'letter' => 'a',
            'description' => 'True'
        ]);
        RiskAssessmentChoice::create([
            'id' => 8,
            'risk_assessments_id' => 4,
            'letter' => 'b',
            'description' => 'False'
        ]);
        RiskAssessmentChoice::create([
            'id' => 9,
            'risk_assessments_id' => 5,
            'letter' => 'a',
            'description' => 'True'
        ]);
        RiskAssessmentChoice::create([
            'id' => 10,
            'risk_assessments_id' => 5,
            'letter' => 'b',
            'description' => 'False'
        ]);
        RiskAssessmentChoice::create([
            'id' => 11,
            'risk_assessments_id' => 6,
            'letter' => 'a',
            'description' => 'True'
        ]);
        RiskAssessmentChoice::create([
            'id' => 12,
            'risk_assessments_id' => 6,
            'letter' => 'b',
            'description' => 'False'
        ]);
        RiskAssessmentChoice::create([
            'id' => 13,
            'risk_assessments_id' => 7,
            'letter' => 'a',
            'description' => 'True'
        ]);
        RiskAssessmentChoice::create([
            'id' => 14,
            'risk_assessments_id' => 7,
            'letter' => 'b',
            'description' => 'False'
        ]);
        RiskAssessmentChoice::create([
            'id' => 15,
            'risk_assessments_id' => 8,
            'letter' => 'a',
            'description' => 'Very conservative'
        ]);
        RiskAssessmentChoice::create([
            'id' => 16,
            'risk_assessments_id' => 8,
            'letter' => 'b',
            'description' => 'Somewhat Conservative'
        ]);
        RiskAssessmentChoice::create([
            'id' => 17,
            'risk_assessments_id' => 8,
            'letter' => 'c',
            'description' => 'Moderate'
        ]);
        RiskAssessmentChoice::create([
            'id' => 18,
            'risk_assessments_id' => 8,
            'letter' => 'd',
            'description' => 'Somewhat Aggressive'
        ]);
        RiskAssessmentChoice::create([
            'id' => 19,
            'risk_assessments_id' => 8,
            'letter' => 'e',
            'description' => 'Very Aggressive'
        ]);
        RiskAssessmentChoice::create([
            'id' => 20,
            'risk_assessments_id' => 9,
            'letter' => 'a',
            'description' => 'Less than a year'
        ]);
        RiskAssessmentChoice::create([
            'id' => 21,
            'risk_assessments_id' => 9,
            'letter' => 'b',
            'description' => '1-2 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 22,
            'risk_assessments_id' => 9,
            'letter' => 'c',
            'description' => '3-5 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 23,
            'risk_assessments_id' => 9,
            'letter' => 'd',
            'description' => '6-9 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 24,
            'risk_assessments_id' => 9,
            'letter' => 'e',
            'description' => '10-15 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 25,
            'risk_assessments_id' => 9,
            'letter' => 'f',
            'description' => '15-25 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 26,
            'risk_assessments_id' => 9,
            'letter' => 'g',
            'description' => 'More than 25 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 27,
            'risk_assessments_id' => 10,
            'letter' => 'a',
            'description' => 'Lump-sum'
        ]);
        RiskAssessmentChoice::create([
            'id' => 28,
            'risk_assessments_id' => 10,
            'letter' => 'b',
            'description' => '1-2 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 29,
            'risk_assessments_id' => 10,
            'letter' => 'c',
            'description' => '3-5 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 30,
            'risk_assessments_id' => 10,
            'letter' => 'd',
            'description' => '6-9 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 31,
            'risk_assessments_id' => 10,
            'letter' => 'e',
            'description' => '10-15 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 32,
            'risk_assessments_id' => 10,
            'letter' => 'f',
            'description' => '15-25 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 33,
            'risk_assessments_id' => 10,
            'letter' => 'g',
            'description' => 'More than 25 years'
        ]);
        RiskAssessmentChoice::create([
            'id' => 34,
            'risk_assessments_id' => 11,
            'letter' => 'a',
            'description' => 'Strongly Agree'
        ]);
        RiskAssessmentChoice::create([
            'id' => 35,
            'risk_assessments_id' => 11,
            'letter' => 'b',
            'description' => 'Agree'
        ]);
        RiskAssessmentChoice::create([
            'id' => 36,
            'risk_assessments_id' => 11,
            'letter' => 'c',
            'description' => 'Neutral'
        ]);
        RiskAssessmentChoice::create([
            'id' => 37,
            'risk_assessments_id' => 11,
            'letter' => 'd',
            'description' => 'Disagree'
        ]);
        RiskAssessmentChoice::create([
            'id' => 38,
            'risk_assessments_id' => 11,
            'letter' => 'e',
            'description' => 'Strongly Disagree'
        ]);
        RiskAssessmentChoice::create([
            'id' => 39,
            'risk_assessments_id' => 12,
            'letter' => 'a',
            'description' => 'I am willing to bare the consequences of a loss to maximize my returns.'
        ]);
        RiskAssessmentChoice::create([
            'id' => 40,
            'risk_assessments_id' => 12,
            'letter' => 'b',
            'description' => 'I am concerned about losses along with returns.'
        ]);
        RiskAssessmentChoice::create([
            'id' => 41,
            'risk_assessments_id' => 12,
            'letter' => 'c',
            'description' => 'To completely avoid losses is something I am more interested in.'
        ]);    
        RiskAssessmentChoice::create([
            'id' => 42,
            'risk_assessments_id' => 13,
            'letter' => 'a',
            'description' => 'I feel comfortable with stable investments.'
        ]);
        RiskAssessmentChoice::create([
            'id' => 43,
            'risk_assessments_id' => 13,
            'letter' => 'b',
            'description' => 'I am willing to withstand some fluctuations in my investment'
        ]);
        RiskAssessmentChoice::create([
            'id' => 44,
            'risk_assessments_id' => 13,
            'letter' => 'c',
            'description' => 'I am seeking substantial investment returns.'
        ]);   
        RiskAssessmentChoice::create([
            'id' => 45,
            'risk_assessments_id' => 13,
            'letter' => 'd',
            'description' => 'I am seeking potentially high investment returns.'
        ]);     
        RiskAssessmentChoice::create([
            'id' => 46,
            'risk_assessments_id' => 14,
            'letter' => 'a',
            'description' => 'Buying a house'
        ]);
        RiskAssessmentChoice::create([
            'id' => 47,
            'risk_assessments_id' => 14,
            'letter' => 'b',
            'description' => 'Paying college tuition'
        ]);
        RiskAssessmentChoice::create([
            'id' => 48,
            'risk_assessments_id' => 14,
            'letter' => 'c',
            'description' => 'Capitalizing a new business venture'
        ]);   
        RiskAssessmentChoice::create([
            'id' => 49,
            'risk_assessments_id' => 14,
            'letter' => 'd',
            'description' => 'Providing for my retirement'
        ]);       
        RiskAssessmentChoice::create([
            'id' => 50,
            'risk_assessments_id' => 15,
            'letter' => 'a',
            'description' => 'Stay the same'
        ]);
        RiskAssessmentChoice::create([
            'id' => 51,
            'risk_assessments_id' => 15,
            'letter' => 'b',
            'description' => 'Grow moderately'
        ]);
        RiskAssessmentChoice::create([
            'id' => 52,
            'risk_assessments_id' => 15,
            'letter' => 'c',
            'description' => 'Grow substantially'
        ]);   
        RiskAssessmentChoice::create([
            'id' => 53,
            'risk_assessments_id' => 15,
            'letter' => 'd',
            'description' => 'Decrease moderately'
        ]); 
        RiskAssessmentChoice::create([
            'id' => 54,
            'risk_assessments_id' => 15,
            'letter' => 'e',
            'description' => 'Decrease substantially'
        ]);              
    }
}
