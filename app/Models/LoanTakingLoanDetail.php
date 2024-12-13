<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTakingLoanDetail extends Model
{
    use HasFactory;

    protected $table = 'loan_taking_loan_detail';

    protected $fillable = [

        'loan_purpose',
        'loan_date',
        'opponent_fathername',
        'loan_location',
        'loan_amount',
        'loan_witness',
        'loan_docs_write',
        'loan_docs_address',
        'loan_medium',
        'is_loan_docs',
        'is_loan_same',
        'loan_tamasuk_amount',
        'loan_transaction_actual_amount',
        'is_taken_loan_stamp',
        'taken_loan_stamp_amount',
        'is_written_tamsuk_changed',
        'is_land_return_promise',
        'is_other_return_promise',
        'land_used_by_name',
        'land_used_by_address',
        'is_land_stop_promise',
        'land_stop_promise_state',
        'land_stop_promise_who_name',
        'land_stop_promise_used_by_name',
        'land_stop_promise_used_by_address',
        'is_witness_any_promise',
        'witness_any_promise_state',
        'land_rights_possessed_by_whome'



    ];
    public function loanVictim()
    {
        return $this->belongsTo(LoanTakingVictim::class);
    }
}
