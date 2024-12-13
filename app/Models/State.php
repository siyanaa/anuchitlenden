<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class State extends Model
{
    use HasFactory;

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'state_id');
    }


    //Search queryies
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            if (isset($keyword['state_name'])) {

                $query->where('name', $keyword['state_name']);
            }
            if (isset($keyword['district_name'])) {
                $query->whereHas('districts', function ($query) use ($keyword) {
                    // dd($keyword);
                    $query->where('name', $keyword['district_name'])
                        ->whereHas('users', function ($query) use ($keyword) {
                            $query->whereHas('registration', function ($query) use ($keyword) {
                                $query->when(User::isAdmin(), function ($query) {

                                    return $query->where('register_by', Auth::user()->id);
                                });

                                if (isset($keyword['search_text'])) {

                                    $query->where('registration_id', 'like', '%' . $keyword['search_text'] . '%')

                                        ->orWhereHas('applicant', function ($query) use ($keyword) {
                                            $query->where('full_name', 'like', '%' . $keyword['search_text'] . '%');
                                        })
                                        ->orWhereHas('offender', function ($query) use ($keyword) {
                                            $query->where('full_name', 'like', '%' . $keyword['search_text'] . '%');
                                        });
                                }

                                if (isset($keyword['nature_type'])) {

                                    $query->whereHas('transaction_nature', function ($query) use ($keyword) {
                                        $query->whereHas('nature', function ($query) use ($keyword) {
                                            $query->where('title', $keyword['nature_type']);
                                        });
                                    });
                                }

                                if (isset($keyword['proof_type'])) {

                                    $query->whereHas('transaction_proofss', function ($query) use ($keyword) {
                                        $query->whereHas('proof', function ($query) use ($keyword) {
                                            $query->where('title', 'like', $keyword['proof_type']);
                                        });
                                    });
                                }

                                if (isset($keyword['purpose_type'])) {

                                    $query->whereHas('transaction_purpose', function ($query) use ($keyword) {
                                        $query->whereHas('purpose', function ($query) use ($keyword) {
                                            $query->where('title', $keyword['purpose_type']);
                                        });
                                    });
                                }

                                if (isset($keyword['transaction_date'])) {
                                    $query->where('tansaction_date', $keyword['transaction_date']);
                                }
                            })
                                ->orWhereHas('district', function ($query) use ($keyword) {
                                    if (isset($keyword['district_name'])) {

                                        $query->where('name', 'like', '%' . $keyword['search_text'] . '%');
                                    }
                                });
                        });
                });
            }


            $query->orderBy('created_at', 'desc');
        });
        // $rawquery = $query->dumpRawSql();

        // dd(Auth::user());
    }
}
