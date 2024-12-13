<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanGivingDebtorApplicationDetail extends Model
{
    use HasFactory;

    protected $table = 'loan_giving_debtor_application_detail';

    protected $fillable = [

        'debtor_name',
        // 'debtor_state',
        // 'debtor_district',
        'debtor_local',
        // 'debtor_ward',
        'debit_date',
        'debit_amount',
        'debit_medium',
        'other_debtors_no',
        'other_debtors_amount',
        'is_statement_register',
        'statement_register_no',

    ];

    public function loanVictim()
    {
        return $this->belongsTo(LoanGivingVictim::class);
    }
}
