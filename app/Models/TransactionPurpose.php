<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPurpose extends Model
{
    use HasFactory;
    protected $fillable= ['registration_id', 'purpose_id'];


    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
    
    public function purpose()
    {
        return $this->belongsTo(Purpose::class, 'purpose_id');
    }
}
