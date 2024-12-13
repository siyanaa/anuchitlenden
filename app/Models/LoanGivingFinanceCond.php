<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanGivingFinanceCond extends Model
{
    use HasFactory;

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
        'amount_asset_description',
        'finance_name',
        'finance_branch',
        'finance_accountissue_date',
        'finance_data',
        'loan_finance_name',
        'loan_finance_branch',
        'loan_finance_liability',
        'loan_finance_remainingpay'

    ];

    public function financecond()
    {
        return $this->belongsTo(LoanGivingFinanceCond::class);
    }
}
