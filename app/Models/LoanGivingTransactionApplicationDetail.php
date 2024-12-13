<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanGivingTransactionApplicationDetail extends Model
{
    use HasFactory;
    protected $table = 'loan_giving_transaction_application_detail';

    protected $fillable = [
    'trans_medium',
    'trans_amount',
    'trans_capital_medium',
    'trans_capital_amount',
    'comp_amt_rem_prin',
    'comp_amt_rem_interest',
    ];

    public function loanVictim()
    {
        return $this->belongsTo(LoanGivingVictim::class);
    }
}
