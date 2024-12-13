<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nature;
use App\Models\History;
use App\Models\Release;

use App\Models\Registration;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\NoTransactionPurpose;

use Illuminate\Support\Facades\Auth;

use App\Models\OffenderRefundOnRelease;
use App\Models\ApplicantReciveOnRelease;

class ReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = 'फर्छ्यौट सूची ';

        return view('admin.release.index', compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $registration = Registration::select('registration_id', 'id')->get();
        $reason_to_no_transactions = NoTransactionPurpose::select('title', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $page_title = 'फर्छ्यौट सिर्जना';
        return view('admin.release.create', compact('reason_to_no_transactions', 'natures', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'id' => 'required',
            'registration_id' => 'required',
            'release_agreement_date' => 'required|date',
            'issue_in_court' => 'required|in:0,1', //0=>no, 1=>yes
            'agreement_applied_status' => 'required|in:0,1', //0=>due date applied, 1=>instant
            'applied_due_date' => 'required_if:agreement_applied_status,0',
            'release_criteria' => 'required|in:0,1', //0=>no transaction, 1=>transaction
            'no_transaction_purpose_id' => 'required_if:release_criteria,0',

            'applicant_recive_on_release.nature_id.*' => 'required_if:release_criteria,1',
            'applicant_recive_on_release.amount.*' => 'required_if:release_criteria,1',
            // 'applicant_recive_on_release.kitta.*' => 'required_if:release_criteria,1',

            'offender_refund_on_release.nature_id.*' => 'required_if:release_criteria,1',
            'offender_refund_on_release.amount.*' => 'required_if:release_criteria,1',
            // 'offender_refund_on_release.kitta.*' => 'required_if:release_criteria,1',
            'remarks' => 'nullable',

        ]);

        if ($request->nature_id && in_array(4, $request->nature_id)) {
            // Adding custom validation rules for kitta when nature_id is 4
            $request->validate([
                'applicant_recive_on_release.kitta*' => 'required_if:release_criteria,1', 
                'offender_refund_on_release.kitta.*' => 'required_if:release_criteria,1',
            ]);
        }

        try {

            $user = Auth::user(); // Fetch the authenticated user

            $data = $request->all();
            // dd($data);
            $existingEntry = Release::where('registration_id', $data['id'])->first();
            $registration = Registration::find($data['id']);

            if ($registration) {
                if ($registration->is_active === 1) {
                    return redirect()->back()->with('error', "यो दर्ता नम्बर छलफल फर्छ्याेट हुन सकेन!!");
                }
            }

            if ($existingEntry) {
                return redirect()->back()->with('error', 'यो दर्ता नम्बर फर्छ्याेट भइसकेको छ!!');
            }
            

            // if ($existingEntry) {
            //     // dd($existingEntry);
            //     return redirect()->back()->with('error', 'This registration was already released!!');
            // if ($registration) {

            //     if ($registration->is_active === 1) {
            //         // dd($registration);
            //         return redirect()->back()->with('error', "This registration's Discussion is Deactivated!!");
            //     }

            // } elseif ($existingEntry) {
            //         return redirect()->back()->with('error', 'This registration was already released!!');

            // } else {
                // dd("lala");
                $data['registration_id'] = $data['id'];
                $registration->is_active = 1;
                $savedData = Release::Create($data);

                // dd($savedData);

                if ($savedData) {
                    $this->saveApplicantReciveOnRelease($savedData, $data);
                    $this->saveOffenderRefundOnRelease($savedData, $data);

                    History::create([
                        'description' => 'फर्छ्यौट- ' .$data['registration_id']. ' सिर्जना गरिएको छ। ' . $user->name,
                        'user_id' => Auth::user()->id,
                        'type' => 1,
                        'ip_address' => UtilityFunctions::getUserIP(),
                    ]);
                }

                return redirect()->route('admin.releases.create')->with('success', 'फर्छ्याेट सिर्जना गरिएको छ!!');
            // }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Insert release. with applicant receive
     *
     * @param  \App\Models\Release
     * @return \Illuminate\Http\Response
     */
    public function saveOffenderRefundOnRelease($release_record, $data)
    {
        if (isset($data['offender_refund_on_release']['nature_id']) && count($data['offender_refund_on_release']['nature_id']) > 0) {
            //delete any OffenderRefundOnRelease associated to release id
            $release = OffenderRefundOnRelease::where('release_id', $release_record->id)->delete();

            foreach ($data['offender_refund_on_release']['nature_id'] as $key => $value) {
                $dataready = array(
                    'release_id' => $release_record->id,
                    'registration_id' => $release_record->registration_id,
                    'nature_id' => $data['offender_refund_on_release']['nature_id'][$key],
                    'amount' => $data['offender_refund_on_release']['amount'][$key],
                    'kitta' => $data['offender_refund_on_release']['kitta'][$key],
                );

                $saved = OffenderRefundOnRelease::create($dataready);
            }
            return $saved;
        }
    }

    /**
     * Insert release. with applicant receive
     *
     * @param  \App\Models\Release
     * @return \Illuminate\Http\Response
     */
    public function saveApplicantReciveOnRelease($release_record, $data)
    {
        //dd($release_record);
        if (isset($data['applicant_recive_on_release']['nature_id']) && count($data['applicant_recive_on_release']['nature_id']) > 0) {
            //delete any ApplicantReciveOnRelease associated to release id
            $release = ApplicantReciveOnRelease::where('release_id', $release_record->id)->delete();

            foreach ($data['applicant_recive_on_release']['nature_id'] as $key => $value) {
                $dataready = array(
                    'release_id' => $release_record->id,
                    'registration_id' => $release_record->registration_id,
                    'nature_id' => $data['applicant_recive_on_release']['nature_id'][$key],
                    'amount' => $data['applicant_recive_on_release']['amount'][$key],
                    'kitta' => $data['applicant_recive_on_release']['kitta'][$key],
                );
                $saved = ApplicantReciveOnRelease::create($dataready);
            }
            return $saved;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Release $release)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $release = Release::find($id);
        $reason_to_no_transactions = NoTransactionPurpose::select('title', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $page_title = 'फर्छ्याेट सम्पादन';
        return view('admin.release.update', compact('release', 'reason_to_no_transactions', 'natures', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Release $release)
    {
        $validatedData = $request->validate([
            // 'id' => 'required',
            'registration_id' => 'required',
            'release_agreement_date' => 'required|date',
            'issue_in_court' => 'required|in:0,1', //0=>no, 1=>yes
            'agreement_applied_status' => 'required|in:0,1', //0=>due date applied, 1=>instant
            'applied_due_date' => 'required_if:agreement_applied_status,0',
            'release_criteria' => 'required|in:0,1', //0=>no transaction, 1=>transaction
            'no_transaction_purpose_id' => 'required_if:release_criteria,0',

            'applicant_recive_on_release.nature_id.*' => 'required_if:release_criteria,1',
            'applicant_recive_on_release.amount.*' => 'required_if:release_criteria,1',
            // 'applicant_recive_on_release.kitta.*' => 'required_if:release_criteria,1',

            'offender_refund_on_release.nature_id.*' => 'required_if:release_criteria,1',
            'offender_refund_on_release.amount.*' => 'required_if:release_criteria,1',
            // 'offender_refund_on_release.kitta.*' => 'required_if:release_criteria,1',
            'remarks' => 'nullable'

        ]);

        if ($request->nature_id && in_array(4, $request->nature_id)) {
            // Adding custom validation rules for kitta when nature_id is 4
            $request->validate([
                'applicant_recive_on_release.kitta*' => 'required_if:release_criteria,1', 
                'offender_refund_on_release.kitta.*' => 'required_if:release_criteria,1',
            ]);
        }

        try {
            $user = Auth::user();
            $data = $request->all();
            $releaseData = Release::where('id', $data['release_id'])->first();
            $savedData = $releaseData->update($data);

            if ($savedData) {
                $this->saveApplicantReciveOnRelease($releaseData, $data);
                $this->saveOffenderRefundOnRelease($releaseData, $data);

                History::create([
                    'description' => 'फर्छ्यौट- ' .$validatedData['registration_id']. ' सम्पादन गरिएको छ। ' . $user->name,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
            }

            return redirect()->route('admin.releases.index')->with('success', 'फर्छ्याेट अपडेट गरिएको छ!!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $release = Release::find($id);
        $user = Auth::user();

        if (!$release) {
            return redirect()->back()->with('error', 'Release Record not found.');
        }

        if($release->delete()){
            History::create([
                'description' => 'फर्छ्यौट- ' .$release->id. ' मेटैएको छ। ' . $user->name,
                'user_id' => Auth::user()->id,
                'type' => 1,
                'ip_address' => UtilityFunctions::getUserIP(),
            ]);
        };

        return redirect()->back()->with('success', 'फर्छ्याेट डिलिट गरिएको छ!!');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllReseaseById(Request $request)
    {
        $releases = $this->getAllForDataTable($request->all());

        return Datatables::of($releases)
            ->escapeColumns([])
            ->addColumn('registration_id', function ($releases) {
                return $releases->registrations->registration_id;
            })
            ->addColumn('release_agreement_date', function ($releases) {
                return $releases->release_agreement_date;
            })
            ->addColumn('issue_in_court', function ($releases) {
                return $releases->issue_in_court == 1 ? '<span>छ</span>' : '<span>छैन</span>';
            })
            ->addColumn('release_criteria', function ($releases) {
                return $releases->release_criteria == 1 ? '<span>लिनदिन पर्ने गरी</span>' : '<span>लिनदिन नपर्ने गरी</span>';
            })
            ->addColumn('agreement_applied_status', function ($releases) {
                return $releases->agreement_applied_status == 1 ? '<span>तत्काल</span>' : '<span>लागू हुने मिति</span>';
            })
            ->addColumn('applied_due_date', function ($releases) {
                return $releases->applied_due_date;
            })
            ->addColumn('created_at', function ($releases) {
                return $releases->created_at->diffForHumans();
            })
            //if view required add on action column
            // <a href="'.route('admin.releases.show', $registrations->id).'" class="action-btn"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
            ->addColumn('actions', function ($releases) {
                return '<a href="' . route('admin.releases.edit', $releases->id) . '" class="btn btn-outline-primary btn-sm mx-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" ></i></a>
            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete' . $releases->id . '"  data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
            <div class="modal fade" id="delete' . $releases->id . '" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form method="POST" action="' . route('admin.releases.destroy', $releases->id) . '" accept-charset="UTF-8" method="POST">
                    <div class="modal-body">
                    
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                    
                      <p>Are you sure to delete <span id="underscore"> ' . $releases->name . ' </span></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        

             ';
            })

            ->make(true);
    }


    // /**
    //  * Get all the required data
    //  *
    //  * @return Response
    //  */
    // public function getForDataTable($registration_id)
    // {
    //     /**
    //      * Note: You must return deleted_at or the news getActionButtonsAttribute won't
    //      * be able to differentiate what buttons to show for each row.
    //      */
    //     $dataTableQuery = Release::where('registration_id', $registration_id)->get();

    //     return $dataTableQuery;
    // }


    /**
     * Get all the required data
     *
     * @return Response
     */
    public function getAllForDataTable($request)
    {
        /**
         * Note: You must return deleted_at or the news getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */

        $dataTableQuery = Release::where(function ($query) use ($request) {
            if (isset($request->id)) {
                $query->where('registration_id', $request->id);
                }
            })
            ->when(User::isAdmin(), function ($query) {
                $query->whereHas('registrations', function ($query) {
                    
                    return $query->where('register_by', Auth::user()->id);
                });
            })
            ->get();

        return $dataTableQuery;
    }


    public function activateRegistrations()
    {
        $releases = Release::all();

        foreach ($releases as $release) {
            if ($release->registrations) {
                $registration = $release->registrations;
                $registration->update(['is_active' => 1]);
            }
        }

        return "Registrations deactivated successfully.";
    }
}
