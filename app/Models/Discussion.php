<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'discussion_date',
        'previous_date',
        'offender_demand_reveal',
        'offender_demand',
        'applicant_willing_to_pay',
        'reason_to_disagreement'
    ];


    public function registrations()
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }


    public function applicant()
    {
        return $this->hasMany(Applicant::class, 'registration_id');
    }

    public function offender()
    {
        return $this->hasMany(Offender::class, 'registration_id');
    }
    

}
