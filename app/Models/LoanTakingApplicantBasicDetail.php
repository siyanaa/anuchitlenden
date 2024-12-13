<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTakingApplicantBasicDetail extends Model
{
    use HasFactory;
    protected $table = 'loan_taking_applicant_basic_detail';

    protected $fillable = [

        'applicant_name',
        'applicant_age',
        'applicant_citizenship',
        'applicant_citizenship_issue_district',
        'applicant_citizenship_issue_date',
        'applicant_fathername',
        'applicant_fathers_no',
        'applicant_spouse',
        'applicant_spouse_no',
        'applicant_family',
        'applicant_annual_income',
        'applicant_permanent_state',
        'applicant_permanent_district',
        'applicant_permanent_local',
        'applicant_permanent_ward',
        'applicant_temp_state',
        'applicant_temp_district',
        'applicant_temp_local',
        'applicant_temp_ward',
        'applicant_pan',
        'applicant_occup',
        'applicant_edu',
    ];

    public function loanVictim()
    {
        return $this->belongsTo(LoanTakingVictim::class);
    }
}
