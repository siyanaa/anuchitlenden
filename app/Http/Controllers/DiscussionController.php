<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\History;
use App\Models\Discussion;
use App\Models\Transaction;
use App\Models\Registration;

use Illuminate\Http\Request;
use App\Models\TransactionProof;
use Yajra\Datatables\Datatables;
use App\Models\TransactionNature;
use App\Models\TransactionPurpose;
use Illuminate\Support\Facades\DB;
use App\Models\NoTransactionPurpose;
use Illuminate\Support\Facades\Auth;
use App\DataTables\DiscussionDataTable;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DiscussionDataTable $dataTable)
    {
        $registration = Registration::all();

        // dd($registration);

        $discussions = Discussion::with('registrations')->get();

        $page_title = 'छलफल सूची';

        return view('admin.discussion.index', compact('discussions', 'registration', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $registration = Registration::select('registration_id', 'id')->get();
        $page_title = 'छलफल सिर्जना';

        // dd($registration[2]->id);


        // Get the selected registration's ID from the form input
        $selectedRegistrationId = $request->input('registration_id');

        // Retrieve the last discussion's date for the selected registration
        $lastDiscussionDate = Discussion::where('registration_id', $selectedRegistrationId)
            ->orderBy('discussion_date', 'desc')
            ->value('discussion_date');

        $previousDates = Discussion::where('registration_id', $selectedRegistrationId)
            ->pluck('previous_date');
            
        // dd($previousDates);

        return view('admin.discussion.create', compact('page_title', 'registration', 'lastDiscussionDate', 'previousDates'));
    }

    // public function getPreviousDates(Request $request)
    // {
    //     $registrationId = $request->input('registration_id');
        
    //     // Retrieve the previous dates for the selected registration
    //     $previousDates = Discussion::where('registration_id', $registrationId)
    //         // ->where('id', '!=', $request->input('discussion_id')) // Exclude the current discussion if you have an ID
    //         ->pluck('discussion_date')
    //         ->toArray();
    //     // dd($previousDates);
    //     return response()->json($previousDates);
    // }

    public function getPreviousDates(Request $request)
    {
        $registrationId = $request->input('registration_id');
        // dd($registrationId);    
        // Retrieve the discussion_date values for the selected registration
        $discussionDates = Discussion::where('registration_id', $registrationId)
            ->pluck('discussion_date')
            ->toArray();

        // dd($discussionDates);
    
        return response()->json(['previousDates' => $discussionDates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDiscussion($registrationId)
    {
        // Retrieve the specific registration based on the ID
        $registration = Registration::findOrFail($registrationId);

        // Calculate last discussion date based on registration_id
        $lastDiscussionDate = Discussion::where('registration_id', $registration->id)
            ->orderBy('discussion_date', 'desc')
            ->value('discussion_date');


        return view('admin.discussion.create', compact('registration', 'lastDiscussionDate'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'registration_id'          => 'required',
    //         // 'registration_id'          => 'required|exists:registrations,id',
    //         'discussion_date'          => 'required|date',
    //         'previous_date'            => 'nullable|date',
    //         'offender_demand_reveal'   => 'nullable',
    //         'offender_demand'          => 'nullable|integer',
    //         'applicant_willing_to_pay' => 'nullable|integer',
    //         'reason_to_disagreement'   => 'nullable|string',
    //     ]);

    //     // Fetch the corresponding registration's id based on registration_id
    //     $registration = Registration::where('registration_id', $validatedData['registration_id'])->first();


    //     // Retrieve the last discussion's date for the same registration_id using the relationship
    //     $lastDiscussionDate = $registration->discussions()
    //         ->orderBy('discussion_date', 'desc')
    //         ->value('discussion_date');
    //     // dd($lastDiscussionDate);

    //     $lastOffenderDemand = $registration->discussions()
    //         ->orderBy('discussion_date', 'desc')
    //         ->value('offender_demand');

    //     if (!$registration) {
    //         return redirect()->back()->with('error', 'Invalid registration_id');
    //     }

    //     try {
    //         $discussion = new Discussion([
    //             'registration_id'          => $registration->id,
    //             'discussion_date'          => $validatedData['discussion_date'],
    //             'previous_date'            => $lastDiscussionDate,
    //             // 'previous_date'            => $lastDiscussionDate ? $validatedData['previous_date'] : null,
    //             // 'previous_date'            => $validatedData['previous_date'],
    //             'offender_demand_reveal'   => $validatedData['offender_demand_reveal'],
    //             'offender_demand'          => $lastOffenderDemand !== null ? $lastOffenderDemand : $validatedData['offender_demand'],
    //             // 'offender_demand'          => $validatedData['offender_demand'],
    //             'applicant_willing_to_pay' => $validatedData['applicant_willing_to_pay'],
    //             'reason_to_disagreement'   => $validatedData['reason_to_disagreement'],
    //         ]);


    //         $discussion->save();

    //         return redirect()->route('admin.discussion.index')->with('success', 'Discussion Was Created');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'registration_id'          => 'required',
            'discussion_date'          => 'required|date',
            'previous_date'            => 'nullable|date',
            'offender_demand_reveal'   => 'nullable',
            'offender_demand'          => 'nullable|integer',
            'applicant_willing_to_pay' => 'nullable|integer',
            'reason_to_disagreement'   => 'nullable|string',
        ]);

        $user = Auth::user(); // Fetch the authenticated user

        // Fetch the corresponding registration for the current user
        $registration = $user->registration()
            ->where('registration_id', $validatedData['registration_id'])
            ->first();

        if (!$registration) {
            return redirect()->back()->with('error', 'Invalid registration_id');
        }

        // Retrieve the last discussion's date and last offender demand using the relationship
        $lastDiscussionDate = $registration->discussions()
            ->orderBy('discussion_date', 'desc')
            ->value('discussion_date');

        $lastOffenderDemand = $registration->discussions()
            ->orderBy('discussion_date', 'desc')
            ->value('offender_demand');

        try {
            $discussion = new Discussion([
                'registration_id'          => $registration->id,
                'discussion_date'          => $validatedData['discussion_date'],
                'previous_date'            => $lastDiscussionDate,
                'offender_demand_reveal'   => $validatedData['offender_demand_reveal'],
                'offender_demand'          => $lastOffenderDemand !== null ? $lastOffenderDemand : $validatedData['offender_demand'],
                'applicant_willing_to_pay' => $validatedData['applicant_willing_to_pay'],
                'reason_to_disagreement'   => $validatedData['reason_to_disagreement'],
            ]);

            // Check if the checkbox is checked and update is_active accordingly
            if ($request->has('deactivateRegistration')) {
                $registration->update(['is_active' => 1]);
            }



            if($discussion->save()){
                History::create([
                    'description' => 'छलफल- ' .$request->registration_id. ' सिर्जना गरिएको छ। ' . $user->name,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
            };

            return redirect()->route('admin.discussion.index')->with('success', 'छलफल सिर्जना गरिएको छ।'); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    // public function show(Discussion $discussion, $id)
    // {
    //     $discussion = Discussion::find($id);

    //     $page_title = "Show Discussion" . $discussion->registrations->registration_id;

    //     return view('admin.discussion.show', compact('page_title', 'discussion'));
    // }

    public function show($registration_id, $id)
    {

        $page_title = "छलफल : " . $registration_id;

        // Retrieve the specific discussion by its ID
        $specificDiscussion = Discussion::find($id);

        $discussions = Discussion::where('registration_id', $specificDiscussion->registration_id)->get();

        // Retrieve the registration data for the specified registration_id
        $registration = $specificDiscussion->registrations;

        // Retrieve applicant data for the same registration
        $applicants = $registration->applicant;

        // Retrieve offender data for the same registration
        $offenders = $registration->offender;

        // $transactions = Transaction::where('registration_id', $specificDiscussion->registrations->id)->get();

        // Retrieve transaction nature details for the registration
        $transactionNature = TransactionNature::where('registration_id', $specificDiscussion->registrations->id)->get();

        $transactionPurpose = TransactionPurpose::where('registration_id', $specificDiscussion->registrations->id)->get();

        // Retrieve transaction_proofss data
        $transactionProofs = TransactionProof::where('registration_id', $specificDiscussion->registrations->id)->get();

        // dd($transactionNature);

        // dd($registration_id);
        // dd($discussions);


        return view('admin.discussion.show', compact('page_title', 'specificDiscussion', 'discussions', 'registration', 'applicants', 'offenders', 'transactionNature', 'transactionPurpose', 'transactionProofs' ));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion, $id)
    {
        $discussion = Discussion::find($id);
        $page_title = 'छलफल सम्पादन';

        // dd($discussion);


        return view('admin.discussion.update', compact('discussion', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {

        $this->validate($request, [
            'registration_id'          => 'required',
            'discussion_date'          => 'required|date',
            'previous_date'            => 'nullable|date',
            'offender_demand'          => 'nullable|integer',
            'applicant_willing_to_pay' => 'nullable|integer',
            'reason_to_disagreement'   => 'nullable|string',
        ]);

        try {
            $user = Auth::user();
            $discussion = Discussion::find($request->id);

            $discussion->registration_id = $request->registration_id;
            $discussion->discussion_date = $request->discussion_date;
            $discussion->previous_date = $request->previous_date;
            $discussion->offender_demand = $request->offender_demand;
            $discussion->applicant_willing_to_pay = $request->applicant_willing_to_pay;
            $discussion->reason_to_disagreement = $request->reason_to_disagreement;

            if($discussion->save()){
                History::create([
                    'description' => 'छलफल- ' .$request->registration_id. ' सम्पादन गरिएको छ। ' . $user->name,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
            };

            return redirect()->route('admin.discussion.index')->with('success', 'छलफल अपडेट गरिएको छ।');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion, $id)
    {
        try {
            $discussion = Discussion::findOrFail($id);
            $user = Auth::user();
            if($discussion->delete()){
                History::create([
                    'description' => 'छलफल- ' .$discussion->id. ' मेटैएको छ। ' . $user->name,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
            };

            return redirect()->route('admin.discussion.index')->with('success', 'छलफल डिलिट गरिएको छ। ');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllDiscussion(Request $request)
    {

        $discussion = $this->getForDataTable($request->all());

        return Datatables::of($discussion)
            ->escapeColumns([])

            ->addColumn('registration_id', function ($discussion) {
                return $discussion->registrations->registration_id;
            })
            ->addColumn('discussion_date', function ($discussion) {
                return $discussion->discussion_date;
            })
            ->addColumn('previous_date', function ($discussion) {
                return $discussion->previous_date;
            })
            ->addColumn('offender_contact', function ($discussion) {
                return $discussion->offender_demand;
            })
            ->addColumn('applicant_willing_to_pay', function ($discussion) {
                return $discussion->applicant_willing_to_pay;
            })
            ->addColumn('reason_to_disagreement', function ($discussion) {
                return $discussion->reason_to_disagreement;
            })
            ->addColumn('created_at', function ($discussion) {
                return $discussion->created_at->diffForHumans();
            })
            ->addColumn('actions', function ($discussions) {
                return '<a href="' . route('admin.discussion.edit', $discussions->id) . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" ></i></a>


                <a href="' . route('admin.discussion.show', ['registration_id' => $discussions->registrations->registration_id, 'id' => $discussions->id]) . '" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa-regular fa-eye"></i></a>

            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
            data-bs-target="#delete' . $discussions->id . '"  data-toggle="tooltip" data-placement="top" title="Delete">
                <i class="far fa-trash-alt"></i>
            </button>
            <div class="modal fade" id="delete' . $discussions->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form method="POST" action="' . route('admin.discussion.destroy', $discussions->id) . '" accept-charset="UTF-8">
                            <div class="modal-body">

                                <input name="_method" type="hidden" value="DELETE">
                                <input name="_token" type="hidden" value="' . csrf_token() . '">

                                <p>Are you sure to delete?</p>
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
    // old show 

    // <a href="' . route('admin.discussion.show', $discussions->id) . '" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Show"><i class="fa-regular fa-eye"></i></a>


    /**
     * Get all the required data
     *
     * @return Response
     */
    // public function getForDataTable($request)
    // {
    //     /**
    //      * Note: You must return deleted_at or the news getActionButtonsAttribute won't
    //      * be able to differentiate what buttons to show for each row.
    //      */
    //     $dataTableQuery = Discussion::where(function ($query) use ($request) {
    //         if (isset($request->id)) {
    //             $query->where('registration_id', $request->id);
    //             }
    //         })
    //         ->when(User::isAdmin(), function ($query) {
    //             $query->whereHas('registrations', function ($query) {
                    
    //                 return $query->where('register_by', Auth::user()->id);
    //             });
    //         })
    //         ->latest();
    //         // ->get();

    //     return $dataTableQuery;
    // }


    
    

    public function getForDataTable($request)
    {
        $latestDiscussionSubquery = Discussion::select('registration_id', DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('registration_id');
    
        $dataTableQuery = Discussion::joinSub($latestDiscussionSubquery, 'latest_discussions', function ($join) {
            $join->on('discussions.registration_id', '=', 'latest_discussions.registration_id')
                ->on('discussions.created_at', '=', 'latest_discussions.latest_created_at');
        })
        ->when(isset($request->id), function ($query) use ($request) {
            $query->where('discussions.registration_id', $request->id);
        })
        ->when(User::isAdmin(), function ($query) {
            $query->whereHas('registrations', function ($query) {
                return $query->where('register_by', Auth::user()->id);
            });
        })
        ->latest('discussions.created_at')
        ->get();
    
        return $dataTableQuery;
    }
    
    

}
