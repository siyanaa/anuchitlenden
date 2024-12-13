<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountData extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'register_by', 'id');
    }
    
}
