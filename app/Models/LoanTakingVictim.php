<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LoanTakingApplicantBasicDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanTakingVictim extends Model
{
    use HasFactory;
    protected $table = 'loan_taking_victim';

    protected $fillable = [
        'registration_id',
        'basic_detail_id',
        'opponent_detail_id',
        'loan_detail_id',
        'court_detail_id',
        'interest_detail_id',
        'additional_detail_id',

    ];

    public function applicationRegistration()
    {
        return $this->belongsTo(LoanTakingApplicationRegistration::class, 'registration_id');
    }

    public function basicDetailRegistration()
    {
        return $this->belongsTo(LoanTakingApplicantBasicDetail::class, 'basic_detail_id');
    }

    public function basicOpponentDetailRegistration()
    {
        return $this->belongsTo(LoanTakingOpponentBasicDetail::class, 'opponent_detail_id');
    }

    public function loanDetail()
    {
        return $this->belongsTo(LoanTakingLoanDetail::class, 'loan_detail_id');
    }

    public function courtDetail()
    {
        return $this->belongsTo(LoanTakingCourtDetail::class, 'court_detail_id');
    }
    public function interestDetail()
    {
        return $this->belongsTo(LoanTakingInterestDetail::class, 'interest_detail_id');
    }

    public function additionalDetail()
    {
        return $this->belongsTo(LoanTakingAdditionalDetail::class, 'additional_detail_id');
    }
}
