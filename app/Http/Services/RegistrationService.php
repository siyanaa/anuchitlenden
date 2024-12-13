<?php

namespace App\Http\Services;

use DB;
use Session;
use App, Auth;
use Carbon\Carbon;
use App\Models\District;
use App\Models\Nature;
use App\Models\State;
use App\Models\Proof;
use App\Models\Purpose;
use Illuminate\Http\Request;


use App\Models\Release;
use App\Models\Registration;
use App\Models\NoTransactionPurpose;

class RegistrationService
{
    /**
     * @var User
     */
    protected $user;


    //Search queryies
    public function scopeSearch($query, $keyword)
    {
        // $query = Registration::query();



        return $query->where(function ($query) use ($keyword) {
            if (isset($keyword['search_text'])) {

                $query->where('registration_id', 'like', '%' . $keyword['search_text'] . '%')

                    ->orWhereHas('applicant', function ($query) use ($keyword) {
                        $query->where('full_name', 'like', '%' . $keyword['search_text'] . '%')
                            ->orWhereHas('district', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword['search_text'] . '%');
                            })
                            ->orWhereHas('local_government', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword['search_text'] . '%');
                            });
                    })
                    ->orWhereHas('offender', function ($query) use ($keyword) {
                        $query->where('full_name', 'like', '%' . $keyword['search_text'] . '%');
                    });
            }
            // if (isset($keyword['state_name'])) {

            //     $query->orWhereHas('user', function ($query) use ($keyword) {
            //         $query->orWhereHas('state', function ($query) use ($keyword) {
            //             $query->where('name', 'like', '%' . $keyword['state_name'] . '%');
            //         });
            //     });
            // }

            if (isset($keyword['district_name'])) {

                $query->whereHas('user', function ($query) use ($keyword) {
                    $query->whereHas('district', function ($query) use ($keyword) {
                        // dd($keyword);
                        $query->where('name', '=', $keyword['district_name']);
                    });
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


            $query->orderBy('tansaction_date', 'desc');
        });
        // $rawquery = $query->dumpRawSql();

        // dd($rawquery);
    }


    public static function RegistrationReports($user_id, $input = null)
    {

        $query = Registration::Join('users', function ($join) use ($input) {
            $join->on('registrations.register_by', '=', 'users.id');
        })
            ->Join('districts', function ($join) use ($input) {
                $join->on('users.district_id', '=', 'districts.id');
            })
            ->Join('applicants', function ($join) use ($input) {
                $join->on('applicants.registration_id', '=', 'registrations.id');
            })
            ->Join('offenders', function ($join) use ($input) {
                $join->on('offenders.registration_id', '=', 'registrations.id');
            })

            ->Join('transaction_natures', function ($join) use ($input) {
                $join->on('transaction_natures.registration_id', '=', 'registrations.id');
            })
            ->Join('natures', function ($join) use ($input) {
                $join->on('transaction_natures.nature_id', '=', 'natures.id');
            })

            ->Join('transaction_proofs', function ($join) use ($input) {
                $join->on('transaction_proofs.registration_id', '=', 'registrations.id');
            })
            ->Join('proofs', function ($join) use ($input) {
                $join->on('transaction_proofs.proof_id', '=', 'proofs.id');
            })


            ->Join('transaction_purposes', function ($join) use ($input) {
                $join->on('transaction_purposes.registration_id', '=', 'registrations.id');
            })

            ->Join('purposes', function ($join) use ($input) {
                $join->on('transaction_purposes.purpose_id', '=', 'purposes.id');
            })

            ->select([
                'registrations.id',
                'registrations.tansaction_date',
                'registrations.is_active',

                'users.id as register_by',
                'users.name',
                'users.email',


                'applicants.id as applicants',
                'applicants.full_name',

                'offenders.id as offenders',
                'offenders.full_name',


                'districts.name as district_name',

                'purposes.title',
                'proofs.title',
                'natures.title'
            ]);
        if (isset($input['search_text'])) {

            $query->where('registration_id', 'like', '%' . $input['search_text'] . '%');
            $query->orWhere('applicants.full_name', 'LIKE', '%' . $input['search_text'] . '%');
            $query->orWhere('applicants.full_name', 'LIKE', '%' . $input['search_text'] . '%');
        }

        if (isset($input['from'])) {
            $query->whereDate('registration_id.created_at', '>=', Carbon::parse($input['from']));
        }

        if (isset($input['to'])) {
            $query->whereDate('stocks.created_at', '<=', Carbon::parse($input['to']));
        }

        if (isset($input['district_name'])) {
            $query->where('district_name', 'LIKE', '%' . $input['search'] . '%');
        }
        if (isset($input['nature_type'])) {
            $query->orWhere('natures.title', 'LIKE', '%' . $input['search'] . '%');
        }
        if (isset($input['proof_type'])) {
            $query->orWhere('natures.title', 'LIKE', '%' . $input['search'] . '%');
        }
        if (isset($input['proof_type'])) {
            $query->orWhere('proofs.title', 'LIKE', '%' . $input['search'] . '%');
        }
        if (isset($input['purpose_type'])) {
            $query->orWhere('purposes.title', 'LIKE', '%' . $input['search'] . '%');
        }
        if (isset($input['transaction_date'])) {
            $query->Where('registrations.tansaction_date', 'LIKE', '%' . $input['search'] . '%');
        }


        dd($query->toSql());
        return $query;
    }
}
