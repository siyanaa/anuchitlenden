<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTakingCourtDetail extends Model
{
    use HasFactory;
    protected $table = 'loan_taking_court_detail';

    protected $fillable = [

        'is_issue_in_court',
        'issue_in_court_result',
        'issue_in_court_subject',
        'issue_in_court_subject_no',
        'is_issue_in_court_applicant_asset_collapse',
        'applicant_collapse_by_who_name',
        'applicant_collapse_by_who_address',
        'is_application_decision_jailtime',
        'is_jail_subjected',
        'if_in_jail_start_date',
        'if_in_jail_start_duration',
        'is_cheque_bounce_case',
        'cheque_bounce_case_result',
        'case_result_bigo',
        'case_result_fine',
        'case_result_jail',
        'if_bank_cheque_case_resulted',


    ];
    public function loanVictim()
    {
        return $this->belongsTo(LoanTakingVictim::class);
    }
}
