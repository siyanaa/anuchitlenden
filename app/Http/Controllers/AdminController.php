<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Nature;
use App\Models\Release;

use App\Models\District;
use App\Models\Offender;
use App\Models\Applicant;
use App\Models\Discussion;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Imports\CombinedImport;
use App\Models\TransactionProof;
use App\Models\TransactionNature;
use App\Models\TransactionPurpose;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\NoTransactionPurpose;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\OffenderRefundOnRelease;
use App\Models\ApplicantReciveOnRelease;
use App\Models\Proof;
use App\Models\Purpose;
use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Console\View\Components\Alert;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();


        $activeRegistrationsCount = 0;

        // if ($user->role == 1 || $user->role == 2 || $user->role == 4) {
        //     // Users with role 1 or 2 can see all data
        //     $activeRegistrationsCount = Discussion::whereDoesntHave('registrations.releases')->count();
        // } elseif ($user->role == 3) {
        //     // Users with role 3 can only see their respective data
        //     $user->registration->each(function ($registration) use (&$activeRegistrationsCount) {
        //         $discussionCount = $registration->discussions()
        //             ->whereDoesntHave('registrations.releases')
        //             ->count();
        //         $activeRegistrationsCount += $discussionCount;
        //     });
        // }

        if ($user->role == 1 || $user->role == 2 || $user->role == 4) {
            // Users with role 1 or 2 can see all data
            $activeRegistrationsCount = Discussion::whereDoesntHave('registrations.releases')
                ->whereHas('registrations', function ($query) {
                    $query->where('is_active', 1);
                })
                ->count();
        } elseif ($user->role == 3) {
            // Users with role 3 can only see their respective data
            $user->registration->each(function ($registration) use (&$activeRegistrationsCount) {
                $discussionCount = $registration->discussions()
                    ->whereDoesntHave('registrations.releases')
                    ->whereHas('registrations', function ($query) {
                        $query->where('is_active', 1);
                    })
                    ->count();
                $activeRegistrationsCount += $discussionCount;
            });
        }

        $activeDiscussion = 0;

        if ($user->role == 1 || $user->role == 2 || $user->role == 4) {
            // Users with role 1 or 2 can see all data
            $activeDiscussion = Discussion::whereHas('registrations', function ($query) {
                $query->where('is_active', 0);
            })->count();
        } elseif ($user->role == 3) {
            // Users with role 3 can only see their respective data
            $user->registration->each(function ($registration) use (&$activeDiscussion) {
                $discussionCount = $registration->discussions()
                    ->whereHas('registrations', function ($query) {
                        $query->where('is_active', 0);
                    })->count();
                $activeDiscussion += $discussionCount;
            });
        };
        // dd($activeRegistrationsCount);

        // $no_transaction_purposes = NoTransactionPurpose::all();

        // // dd($no_transaction_purposes);

        // $no_transaction_datasets = [];

        // foreach ($no_transaction_purposes as $purpose) {
        //     $data = Release::where('release_criteria', 0)
        //         ->where('no_transaction_purpose_id', $purpose->id)
        //         ->count();

        //     $no_transaction_datasets[] = [
        //         'label' => $purpose->title, // Use the title as the label
        //         'data' => [$data],
        //         'backgroundColor' => '#FF0000', // Customize the color as needed
        //     ];
        // }

        // dd($no_transaction_datasets);


        $registrations = Registration::where(function ($query) {
            $query->when(User::isAdmin(), function ($query) {

                return $query->where('register_by', Auth::user()->id);
            });
        })
            ->get();

        $discussions = Discussion::whereHas('registrations', function ($query) {
            $query->when(User::isAdmin(), function ($query) {
                $query->where('register_by', Auth::user()->id);
            });
        })->get();

        $releases = Release::whereHas('registrations', function ($query) {
            $query->when(User::isAdmin(), function ($query) {
                $query->where('register_by', Auth::user()->id);
            });
        })->get();




        $graphs = [
            'registration' => $registrations->count(),
            'discussions' => $discussions->count(),
            'releases' => $releases->count(),
        ];

        $districts = District::pluck('name')->toArray();

        $districtData = [];

        $uniqueDistrictIds = User::pluck('district_id');

        // dd($uniqueDistrictIds);

        for ($districtId = 1; $districtId <= count($uniqueDistrictIds); $districtId++) {
            // Find the district by its ID
            $district = District::find($districtId);

            // dd($district);

            if ($district) {
                $registrationsCount = Registration::whereHas('user', function ($query) use ($districtId) {
                    $query->when(User::isAdmin(), function ($query) {
                        $query->where('register_by', Auth::user()->id);
                    });
                    $query->where('district_id', $districtId);
                })->count();

                $discussionssCount = Discussion::whereHas('registrations', function ($query) use ($districtId) {
                    $query->where('is_active', 0);
                    $query->whereHas('user', function ($query) use ($districtId) {
                        $query->where('district_id', $districtId);
                    });
                })->count();



                $releasesCount = Release::whereHas('registrations.user', function ($query) use ($districtId) {
                    $query->when(User::isAdmin(), function ($query) {
                        $query->where('register_by', Auth::user()->id);
                    });
                    $query->where('district_id', $districtId);
                })->count();

                // Append data for each district to the $districtData array
                $districtData[$district->name] = [
                    'registration' => $registrationsCount,
                    'discussions' => $discussionssCount,
                    'releases' => $releasesCount,
                ];
            }
        }

        $countsByState = $this->countByState();


        $districtsfornotran = District::all();

        $districtId = Auth::user()->district_id;

        $initialData = Release::whereHas('registrations.user', function ($query) use ($districtId) {
            $query->where('district_id', $districtId);
        })
            ->where('release_criteria', 0)
            ->select('no_transaction_purpose_id', DB::raw('count(*) as count'))
            ->groupBy('no_transaction_purpose_id')
            ->get();


        $notransaction_districtCount = Release::where('release_criteria', 0)
            ->whereHas('registrations', function ($query) use ($user) {
                $query->where('register_by', $user->id);
            })
            ->select('no_transaction_purpose_id', DB::raw('count(*) as count'))
            ->groupBy('no_transaction_purpose_id')
            ->get();



        return view('admin.index', compact('districtData', 'graphs', 'districts', 'activeRegistrationsCount', 'countsByState', 'activeDiscussion', 'districtsfornotran', 'initialData', 'notransaction_districtCount'));
    }


    // public function getOffenderRefundDataForDistrict(Request $request)
    // {
    //     // Get the district ID from the request
    //     $districtId = $request->input('district_id');
    
    //     // Fetch OffenderRefundOnRelease data based on the district ID
    //     $data = OffenderRefundOnRelease::whereHas('releases.registrations.user', function ($query) use ($districtId) {
    //         $query->where('district_id', $districtId);
    //     })
    //     ->select('nature_id', DB::raw('count(*) as count'))
    //     ->with('nature:title')   // Eager load the 'nature' relationship with 'title'
    //     ->groupBy('nature_id')
    //     ->get();
    
    //     return response()->json($data);
    // }
    

    public function getDataForDistrict(Request $request)
    {
        // Get the district ID from the request
        $districtId = $request->input('district_id');

        // Fetch data based on the district ID
        $data = Release::whereHas('registrations.user', function ($query) use ($districtId) {
            $query->where('district_id', $districtId);
        })
            ->where('release_criteria', 0)
            ->select('no_transaction_purpose_id', DB::raw('count(*) as count'))
            ->groupBy('no_transaction_purpose_id')
            ->get();

        return response()->json($data);
    }

    public function selectState()
    {
        // Fetch a list of states and render a view for state selection
        $states = State::all();
        return view('select-state', compact('states'));
    }

    public function getDistrictsByState(State $state)
    {
        // Fetch districts based on the selected state
        $districts = $state->districts;
        return response()->json($districts);
    }

    public function getLocalGovernmentsByDistrict(District $district)
    {
        // Fetch local governments based on the selected district
        $localGovernments = $district->localGovernments;
        return response()->json($localGovernments);
    }


    public function importIndex()
    {
        $natures = Nature::all();
        $purposes = Purpose::all();
        $proofs = Proof::all();

        $states = State::all();


        return view('admin.import-index', compact('natures', 'purposes', 'proofs', 'states'));
    }

    public function generateReleaseCounts()
    {
        $noTransactionPurposes = NoTransactionPurpose::all();

        $releaseCounts = [];

        foreach ($noTransactionPurposes as $purpose) {
            $count = Release::where('release_criteria', 0)
                ->where('no_transaction_purpose_id', $purpose->id)
                ->count();

            $releaseCounts[] = [
                'label' => $purpose->title,
                'count' => $count,
            ];
        }

        return response()->json($releaseCounts);
    }


    // private function countByState()
    // {
    //     return DB::table('states')
    //         ->leftJoin('districts', 'states.id', '=', 'districts.state_id')
    //         ->leftJoin('users', 'districts.id', '=', 'users.district_id')
    //         ->leftJoin('registrations', 'users.id', '=', 'registrations.register_by')
    //         ->leftJoin('discussions', function ($join) {
    //             $join->on('registrations.id', '=', 'discussions.registration_id');
    //         })
    //         ->leftJoin('releases', function ($join) {
    //             $join->on('discussions.id', '=', 'releases.registration_id');
    //         })
    //         ->select(
    //             'states.name as state_name',
    //             DB::raw('count(distinct registrations.id) as registrations_count'),
    //             DB::raw('count(distinct discussions.id) as discussions_count'),
    //             DB::raw('count(distinct releases.id) as releases_count'),
    //             DB::raw('sum(registrations.is_active) as active_registrations_count')
    //         )
    //         ->groupBy('states.name')
    //         ->get();
    // }

    //     private function countByState()
    // {
    //     return DB::table('states')
    //         ->leftJoin('districts', 'states.id', '=', 'districts.state_id')
    //         ->leftJoin('users', 'districts.id', '=', 'users.district_id')
    //         ->leftJoin('registrations', 'users.id', '=', 'registrations.register_by')
    //         ->leftJoin('discussions', function ($join) {
    //             $join->on('registrations.id', '=', 'discussions.registration_id');
    //         })
    //         ->leftJoin('releases', function ($join) {
    //             $join->on('discussions.id', '=', 'releases.registration_id');
    //         })
    //         ->select(
    //             'states.name as state_name',
    //             DB::raw('count(distinct registrations.id) as registrations_count'),
    //             DB::raw('count(distinct discussions.id) as discussions_count'),
    //             DB::raw('count(distinct releases.id) as releases_count'),
    //             DB::raw('sum(CASE WHEN registrations.is_active = 1 THEN 1 ELSE 0 END) as active_registrations_count')
    //         )
    //         ->groupBy('states.name')
    //         ->get();
    // }

    private function countByState()
    {
        return DB::table('states')
            ->leftJoin('districts', 'states.id', '=', 'districts.state_id')
            ->leftJoin('users', 'districts.id', '=', 'users.district_id')
            ->leftJoin('registrations', 'users.id', '=', 'registrations.register_by')
            ->leftJoin('discussions', function ($join) {
                $join->on('registrations.id', '=', 'discussions.registration_id');
            })
            ->leftJoin('releases', function ($join) {
                $join->on('discussions.id', '=', 'releases.registration_id');
            })
            ->select(
                'states.name as state_name',
                DB::raw('count(distinct registrations.id) as registrations_count'),
                DB::raw('count(distinct CASE WHEN discussions.registration_id IN (
                SELECT id FROM registrations WHERE is_active = 0
            ) THEN discussions.id END) as discussions_count'),
                DB::raw('count(distinct releases.id) as releases_count'),
                DB::raw('count(distinct CASE WHEN registrations.is_active = 1 AND NOT EXISTS (
                SELECT 1 FROM releases WHERE releases.registration_id = registrations.id
            ) THEN registrations.id END) as active_registrations_count')
            )
            ->groupBy('states.name')
            ->get();
    }





    public function import(Request $request)
    {

        try {
            $array1 = Excel::toCollection(new CombinedImport, $request->file('file'));
            // dd($array1);
            // Access the outer collection
            foreach ($array1 as $outerCollection) {
                // Iterate through the inner collections
                foreach ($outerCollection as $row) {
                    // dd($row);
                    $registrationId = Auth::user()->district_id . '-' . $row['registration_no'];

                    $oNames = explode(',', $row['o_name']);
                    $oStates = explode(',', $row['o_state']);
                    $oDistricts = explode(',', $row['o_district']);
                    $oLocalbodies = explode(',', $row['o_local_govn']);
                    $oWadas = explode(',', $row['o_ward']);

                    $purposeIds = explode(',', $row['tran_purp']);
                    $proofIds = explode(',', $row['tran_proof']);

                    $rNatureValues = explode(',', $row['r_nature']);
                    $rAmountValues = explode(',', $row['r_amount']);

                    $orNatureValues = explode(',', $row['or_nature']);
                    $orAmountValues = explode(',', $row['or_amount']);



                    // Access and process the data within each row
                    $registration = Registration::create([
                        'registration_id' => $registrationId,
                        'register_by' => Auth::user()->id,
                        'transaction_amount' => $row['a_tran_amount'],
                        'tansaction_date' => !empty($row['tran_date']) ? $row['tran_date'] : null,

                        // 'is_active' => 0 or 1 
                    ]);


                    $aNames = explode(',', $row['a_name']);
                    $aStates = explode(',', $row['a_state']);
                    $aDistricts = explode(',', $row['a_district']);
                    $aLocalGovns = explode(',', $row['a_local_govn']);
                    $aWards = explode(',', $row['a_ward']);

                    // Create applicant records
                    foreach ($aNames as $key => $aName) {
                        // echo $aName;
                        $applicant = new Applicant([
                            'registration_id' => $registration->id,
                            'full_name' => !empty(trim($aName)) ? trim($aName) : "नखुलेको", // Trim whitespace
                            'state_id' => intval(trim($aStates[$key]))
                        ]);

                        if (isset($aDistricts[$key])) {
                            $applicant->district_id = intval(trim($aDistricts[$key]));
                        }
                        if (isset($aLocalGovns[$key])) {
                            $applicant->localbody_id = intval(trim($aLocalGovns[$key]));
                        }
                        if (isset($aWards[$key])) {
                            $applicant->wada_id = intval(trim($aWards[$key]));

                            // dd($applicant->wada_id);
                        }

                        $applicant->save();
                    }
                    // dd('zxc');

                    // Create offender records
                    foreach ($oNames as $key => $oName) {
                        Offender::create([
                            'registration_id' => $registration->id,
                            'full_name' => !empty(trim($oName)) ? trim($oName) : "नखुलेको", // Trim whitespace
                            'state_id' => intval(trim($oStates[$key])),
                            'district_id' => intval(trim($oDistricts[$key])),
                            'localbody_id' => !empty($oLocalbodies[$key]) ? intval(trim($oLocalbodies[$key])) : null,
                            'wada_id' => !empty($oWadas[$key]) ? intval(trim($oWadas[$key])) : null,

                        ]);
                    }

                    foreach ($purposeIds as $purposeId) {
                        TransactionPurpose::create([
                            'registration_id' => $registration->id,
                            'purpose_id' => intval(trim($purposeId)),
                        ]);
                    }

                    foreach ($proofIds as $proofId) {
                        TransactionProof::create([
                            'registration_id'  => $registration->id,
                            'proof_id' => intval(trim($proofId)),
                            'amount' => !empty($row['a_tran_amount']) ? $row['a_tran_amount'] : 0,
                        ]);
                    }


                    // Check if o_demand_amount exists in the dataset
                    if ($row['o_demand_amount']) {
                        $offenderDemandReveal = 'yes';
                    } else {
                        $offenderDemandReveal = 'no';
                    }

                    if ($row['issue_in_court']) {
                        $issue_in_court = 1;
                    } else {
                        $issue_in_court = 0;
                    }

                    Discussion::create([
                        'registration_id' => $registration->id,
                        'discussion_date' => !empty($row['r_date']) ? $row['r_date'] : null,
                        'offender_demand_reveal' => $offenderDemandReveal,
                        'offender_demand' => $row['o_demand_amount']

                    ]);


                    // $release_criteria = $row['r_criteria'] ?? 0;

                    // // dd($release_criteria);

                    // $releaseData = [
                    //     'registration_id' => $registration->id,
                    //     'release_agreement_date' => $row['r_date'],
                    //     'issue_in_court' => $issue_in_court,
                    //     'remarks' => $row['remarks'],
                    //     'release_criteria' => $release_criteria
                    //     // Other Release fields
                    // ];

                    // if ($release_criteria == 0) {
                    //     // Set no_transaction_purpose_id when release_criteria is 0
                    //     $releaseData['no_transaction_purpose_id'] = $row['no_tran_id']; // Assuming you have this value in $row
                    //     // dd($releaseData['no_transaction_purpose_id']);
                    // }

                    // $release = Release::create($releaseData);
                    // $registration->update(['is_active' => 1]);

                    // foreach ($rNatureValues as $key => $rNatureValue) {
                    //     // Set nature_id to 0 if rNatureValue is empty
                    //     $natureId = empty($rNatureValue) ? 0 : intval(trim($rNatureValue));

                    //     // Set amount to 0 if rAmountValues is empty
                    //     $amount = empty($rAmountValues[$key]) ? 0 : trim($rAmountValues[$key]);

                    //     // Create OffenderRefundOnRelease records
                    //     ApplicantReciveOnRelease::create([
                    //         'registration_id' => $registration->id,
                    //         'release_id' => $release->id,
                    //         'nature_id' => $natureId,
                    //         'amount' => $amount,
                    //     ]);
                    // }


                    // foreach ($orNatureValues as $key => $orNatureValue) {
                    //     // Set nature_id to 0 if orNatureValue is empty
                    //     $natureId = empty($orNatureValue) ? 0 : intval(trim($orNatureValue));

                    //     // Set amount to 0 if orAmountValues is empty
                    //     $amount = empty($orAmountValues[$key]) ? 0 : trim($orAmountValues[$key]);

                    //     // Create OffenderRefundOnRelease records
                    //     OffenderRefundOnRelease::create([
                    //         'registration_id' => $registration->id,
                    //         'release_id' => $release->id,
                    //         'nature_id' => $natureId,
                    //         'amount' => $amount,
                    //     ]);
                    // }
                    if (
                        (!empty($row['r_nature']) || $row['r_nature'] === '0') ||
                        (!empty($row['r_amount']) || $row['r_amount'] === '0') ||
                        // !empty($row['r_date']) &&
                        (!empty($row['or_nature']) || $row['or_nature'] === '0') ||
                        (!empty($row['or_amount']) || $row['or_amount'] === '0')
                    ) {

                        // dd($row['r_date']);
                        $release_criteria = $row['r_criteria'] ?? 0;

                        $releaseData = [
                            'registration_id' => $registration->id,
                            'release_agreement_date' => $row['r_date'],
                            'issue_in court' => $issue_in_court,
                            'remarks' => $row['remarks'],
                            'release_criteria' => $release_criteria,
                            // Other Release fields
                        ];

                        if ($release_criteria == 0) {
                            // Set no_transaction_purpose_id when release_criteria is 0
                            $releaseData['no_transaction_purpose_id'] = $row['no_tran_id']; // Assuming you have this value in $row
                            // dd($releaseData['no_transaction_purpose_id']);
                        }

                        // All necessary columns are not empty, so create the Release record
                        $release = Release::create($releaseData);
                        $registration->update(['is_active' => 1]);

                        foreach ($rNatureValues as $key => $rNatureValue) {
                            $natureId = empty($rNatureValue) ? 0 : intval(trim($rNatureValue));
                            $amount = empty($rAmountValues[$key]) ? 0 : trim($rAmountValues[$key]);

                            // Create OffenderRefundOnRelease records
                            ApplicantReciveOnRelease::create([
                                'registration_id' => $registration->id,
                                'release_id' => $release->id,
                                'nature_id' => $natureId,
                                'amount' => $amount,
                            ]);
                        }

                        foreach ($orNatureValues as $key => $orNatureValue) {
                            $natureId = empty($orNatureValue) ? 0 : intval(trim($orNatureValue));
                            $amount = empty($orAmountValues[$key]) ? 0 : trim($orAmountValues[$key]);

                            // Create OffenderRefundOnRelease records
                            OffenderRefundOnRelease::create([
                                'registration_id' => $registration->id,
                                'release_id' => $release->id,
                                'nature_id' => $natureId,
                                'amount' => $amount,
                            ]);
                        }
                    }
                }
            }


            return back()->with('success', 'डाटा अपलोड भएको छ ।');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
