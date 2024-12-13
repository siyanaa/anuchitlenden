<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTakingAdditionalDetail extends Model
{
    use HasFactory;
    protected $table = 'loan_taking_additional_detail';

    protected $fillable = [
        'applicant_house_no',
        'applicant_house_area',
        'applicant_house_type',
        'applicant_house_storeyed',
        'applicant_house_state',
        'applicant_house_district',
        'applicant_house_local',
        'applicant_house_ward',
        'applicant_land_kitta_no',
        'applicant_land_area',
        'applicant_land_state',
        'applicant_land_district',
        'applicant_land_local',
        'applicant_land_ward',
        'applicant_vehicle_details',
        'applicant_current_asset_details',
        'applicant_org_name',
        'applicant_finance_org_branch',
        'applicant_account_opening_date',
        'applicant_finance_amount',
        'transaction_actual_interest',
        'application_verifying_document',
        'application_document_file',
        'is_crime_reported',
        'if_crime_reported',
        'stamp_person_name',
        'stamp_person_signature',
        'stamp_date',
    ];

    public function loanVictim()
    {
        return $this->belongsTo(LoanTakingVictim::class);
    }
}
