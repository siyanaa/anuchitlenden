<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Registration;
use App\Models\Applicant;


class Offender extends Model
{
    use HasFactory;

    protected $fillable =[
        'registration_id',
        'full_name',
        'contact',
        'state_id',
        'district_id',
        'localbody_id',
        'wada_id',
    ];

    
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function district_bystate($state_id)
    {
        // dd($state_id);
        return District::select('name', 'id', 'state_id')->where('state_id', $state_id)->get();
    }
    
    
    public function localbody_bydistrict($district_id)
    {
        return LocalGovernment::select('name', 'id', 'district_id')->where('district_id', $district_id)->get();
    }
    
    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class);
    }

    public function local_government()
    {
        return $this->belongsTo(LocalGovernment::class, 'localbody_id');
    }
}
