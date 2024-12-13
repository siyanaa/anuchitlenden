<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanTakingApplicationRegistration extends Model
{
    use HasFactory;
    protected $table = 'loan_taking_application_registration';

    protected $fillable = [
        'registration_id',
        'registration_date',
        'registration_office',
    ];

    public function loanVictim()
    {
        return $this->belongsTo(LoanTakingVictim::class);
    }
}
