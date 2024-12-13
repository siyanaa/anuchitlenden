<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionProof extends Model
{
    use HasFactory;

    protected $fillable= ['registration_id', 'proof_id', 'amount'];


    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
    
    public function proof()
    {
        return $this->belongsTo(Proof::class, 'proof_id');
    }
    
}
