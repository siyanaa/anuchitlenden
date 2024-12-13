<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTakingInterestDetail extends Model
{
    use HasFactory;
    protected $table = 'loan_taking_interest_detail';

    protected $fillable = [

        'written_docs_interest_rate',
        'written_docs_given_interest_rate',
        'till_now_interest_amount',
        'interest_paid_medium',
        'till_now_paid_capital',
        'till_now_to_be_paid_amount',
        'is_registered_inward',
        'registered_no',
        'loan_amount_pay_last_date',
        


    ];
    public function loanVictim()
    {
        return $this->belongsTo(LoanTakingVictim::class);
    }

}
