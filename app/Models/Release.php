<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'no_transaction_purpose_id',
        'release_agreement_date',
        'issue_in_court',
        'release_criteria',
        'agreement_applied_status',
        'applied_due_date',
        'remarks'
    ];


    public function registrations()
    {
        return $this->belongsTo(Registration::class, 'registration_id', 'id');
    }

    public function offenderRefund()
    {
        return $this->hasMany(OffenderRefundOnRelease::class, 'release_id', 'id');
    }

    public function applicantRecive()
    {
        return $this->hasMany(ApplicantReciveOnRelease::class, 'release_id', 'id');
    }

    public function noTransactionPurpose()
    {
        return $this->belongsTo(NoTransactionPurpose::class, 'no_transaction_purpose_id', 'id');
    }
}
