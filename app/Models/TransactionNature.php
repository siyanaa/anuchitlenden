<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionNature extends Model
{
    use HasFactory;

    protected $fillable= ['registration_id', 'nature_id'];


    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
    
    public function nature()
    {
        return $this->belongsTo(Nature::class, 'nature_id');
    }
}
