<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RiskAssessment;

class RiskAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RiskAssessment::create([
            'id' => 1,
            'question' => 'Are you exposed to the any radiation',
        ]);
        RiskAssessment::create([
            'id' => 2,
            'question' => 'Are you working at times of day that could affect vision?',
        ]);
        RiskAssessment::create([
            'id' => 3,
            'question' => 'Are you dealing with chemicals trained or certified in handling those specific chemicals?',
        ]);
        RiskAssessment::create([
            'id' => 4,
            'question' => 'Is there proper disposal of biological hazards available?',
        ]);
        RiskAssessment::create([
            'id' => 5,
            'question' => "Can injury or strain arise from the design and organization of a worker's workspace?",
        ]);
        RiskAssessment::create([
            'id' => 6,
            'question' => "Are tasks evenly distributed to prevent one individual from experiencing work overload?",
        ]);
        RiskAssessment::create([
            'id' => 7,
            'question' => "Are job roles defined so workers don't feel uncertain and lacking job control?",
        ]);
        RiskAssessment::create([
            'id' => 8,
            'question' => "What is your investment attitude?",
        ]);
        RiskAssessment::create([
            'id' => 9,
            'question' => "In how many years will you begin making withdrawals from your investment?",
        ]);
        RiskAssessment::create([
            'id' => 10,
            'question' => "Once you begin to make your withdrawals, how many years will you be making withdrawals?",
        ]);
        RiskAssessment::create([
            'id' => 11,
            'question' => "Protecting my portfolio is more important to me than high returns.",
        ]);
        RiskAssessment::create([
            'id' => 12,
            'question' => "Keeping the above answer option in mind which of the following statements make the most sense to you?",
        ]);
        RiskAssessment::create([
            'id' => 13,
            'question' => "Which of the following statements best describes your investment philosophy?",
        ]);
        RiskAssessment::create([
            'id' => 14,
            'question' => "What do you expect to be your next major expenditure?",
        ]);
        RiskAssessment::create([
            'id' => 15,
            'question' => "Over the next few years, you expect the annual income to:",
        ]);
    }
}
