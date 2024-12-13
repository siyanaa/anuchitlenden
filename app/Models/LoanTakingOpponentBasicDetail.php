<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTakingOpponentBasicDetail extends Model
{
    use HasFactory;
    protected $table = 'loan_taking_opponent_detail';

    protected $fillable = [

        'opponent_name',
        'opponent_age',
        'opponent_fathername',
        'opponent_fathers_no',
        'opponent_spouse',
        'opponent_spouse_no',
        'opponent_permanent_state',
        'opponent_permanent_district',
        'opponent_permanent_local',
        'opponent_permanent_ward',
        'opponent_temp_state',
        'opponent_temp_district',
        'opponent_temp_local',
        'opponent_temp_ward',
        'opponent_occupation',
        'opponent_education_level',

    ];

    public function loanVictim()
    {
        return $this->belongsTo(LoanTakingVictim::class);
    }
}
