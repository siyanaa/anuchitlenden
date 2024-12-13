<?php

namespace App\Models;


use App\Models\LoanGivingDebtorApplicationDetail;
use App\Models\LoanGivingApplicationRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanGivingVictim extends Model
{
    use HasFactory;
    protected $table = 'loan_giving_victims';

    protected $fillable = [
        'registration_id',
        'register_by',
        'basic_detail_id',
        'transaction_application_detail_id',
        'debtor_application_detail_id',
        'other_detail_id',
        'applicant_finance_cond_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'register_by', 'id');
    }

    public function registrationDetail()
    {
        return $this->belongsTo(LoanGivingApplicationRegistration::class, 'registration_id');
    }

    public function transactionRegistration()
    {
        return $this->belongsTo(LoanGivingTransactionApplicationDetail::class, 'transaction_application_detail_id');
    }

    public function basicDetailRegistration()
    {
        return $this->belongsTo(LoanGivingApplicantBasicDetail::class, 'basic_detail_id');
    }
    public function applicationFinance()
    {
        return $this->belongsTo(LoanGivingApplicationFinanceCond::class, 'applicant_finance_cond_id');
    }

    public function debtorDetails()
    {
        return $this->belongsTo(LoanGivingDebtorApplicationDetail::class, 'debtor_application_detail_id');
    }

    public function otherDetails()
    {
        return $this->belongsTo(LoanGivingApplicationOtherDetails::class, 'other_detail_id');
    }
}
