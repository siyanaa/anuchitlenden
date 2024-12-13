<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanGivingApplicationFinanceCond extends Model
{
    use HasFactory;
    protected $table = 'loan_giving_applicant_finance_cond';

    protected $fillable = [
        'home_no',
        'home_area',
        'home_type',
        'home_storey',
        'home_state',
        'home_district',
        'home_local',
        'home_ward',
        'land_kitta',
        'land_area',
        'land_state',
        'land_district',
        'land_local',
        'land_ward',
        'vehicle_description',
        'vehicle_count',
        'amount_asset_description',
        'amount_asset_count',
        'finance_name',
        'finance_branch',
        'finance_accountissue_date',
        'finance_data',
        'loan_finance_name',
        'loan_finance_branch',
        'loan_finance_liability',
        'loan_finance_remainingpay',
       

    ];

    public function loanVictim()
    {
        return $this->belongsTo(LoanGivingVictim::class);
    }
}
