<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function transaction_proof()
    {
        return $this->hasMany(TransactionProof::class, 'proof_id');
    }
}
