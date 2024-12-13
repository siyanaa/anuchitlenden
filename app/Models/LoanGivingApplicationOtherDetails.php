<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanGivingApplicationOtherDetails extends Model
{
    use HasFactory;

    protected $table = 'loan_giving_application_other_details';

    protected $casts = [
        'is_when_registered_other_docs' => 'array',
        'when_registered_other_condition_name' => 'array',
    ];

    protected $fillable = [

        'loan_landrestrict_owner',
        'loan_taking_person_name',
        'land_passed_name',
        'registered_person_relation',
        'landrestrict_kitta',
        'landrestrict_area',
        'landrestrict_state',
        'landrestrict_district',
        'landrestrict_local',
        'landrestrict_ward',
        'landrestrict_registration_date',
        'is_loan_cheque_shown',
        'cheque_giving_person',
        'cheque_receiving_person',
        'cheque_issue_date',
        'cheque_bounce_date',
        'cheque_detail_amount',
        'cheque_other_details',
        'is_court_case_pending',
        'court_case_state_name',
        'court_case_subject',
        // 'court_case_no',
        'is_amount_short_person_injail',
        'is_court_case_done',
        'landrestricted_usedby_now',
        'is_when_registered_otherdocs',
        'when_registered_othercondition_name',
        'other_details_in_transaction',
        'application_attached_documents',
        'application_document_file',
        'stamped_name',
        'stamped_date',

    ];

    public function loanVictim()
    {
        return $this->belongsTo(LoanGivingVictim::class);
    }
}
