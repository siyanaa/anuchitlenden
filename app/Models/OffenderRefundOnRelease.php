<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffenderRefundOnRelease extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'registration_id',
        'release_id',
        'nature_id',
        'amount',
        'kitta'
    ];

    public function registrations()
    {
        return $this->belongsTo(Registration::class);
    }

    public function releases()
    {
        return $this->belongsTo(Release::class, 'release_id');
    }
    
    public function nature()
    {
        return $this->belongsTo(Nature::class);
    }
}
