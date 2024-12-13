<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Proof;
use App\Models\State;
use App\Models\Nature;
use App\Models\History;
use App\Models\Purpose;
use App\Models\District;
use App\Models\Offender;
use App\Models\Applicant;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\LocalGovernment;
use App\Models\TransactionProof;
use Yajra\Datatables\Datatables;

use App\Models\TransactionNature;
use App\Models\TransactionPurpose;
use Illuminate\Support\Facades\Auth;
use App\DataTables\RegistrationDataTable;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'दर्ता सूची';

        return view('admin.registration.index', compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        $page_title = 'दर्ता सिर्जना';
        return view('admin.registration.create', compact('states', 'purposes', 'proofs', 'natures', 'page_title'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRelease()
    {
        $states = State::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        $page_title = 'Registration Form';
        return view('admin.registration.create', compact('states', 'purposes', 'proofs', 'natures', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'registration_id' => 'required',
            'transaction_amount' => 'required',
            'tansaction_date' => 'required',

            'applicant.full_name.*' => 'required',
            'applicant.contact.*' => 'required',
            'applicant.state_id.*' => 'required',
            'applicant.district_id.*' => 'required',
            'applicant.localbody_id.*' => 'required',
            'applicant.wada_id.*' => 'required',

            'offender.full_name.*' => 'required',
            'offender.contact.*' => 'required',
            'offender.state_id.*' => 'required',
            'offender.district_id.*' => 'required',
            'offender.localbody_id.*' => 'required',
            'offender.wada_id.*' => 'required',
            
            'proof.*' => 'required',
            'nature_id.*' => 'required',
            'purpose_id.*' => 'required',
        ]);

        try{
            // Generate a unique reg_no based on user's name
            $user = Auth::user();
            $unique_reg_no = $user->district_id . '-' . $validatedData['registration_id'];

            // Check if the generated unique_registration_id is unique for the user
            // $count = Registration::where('registration_id', $validatedData['registration_id'])
            // ->where('register_by', $user->id)
            // ->count();

            $count = Registration::where('registration_id', $unique_reg_no)
            ->where('register_by', $user->id)
            ->count();

            if ($count > 0) {

                return redirect()->back()->with('error', 'दर्ता नम्बर पहिले नै सिर्जना गरिएको छ।');
            }

            $data = $request->all();

            $tansactionDate = Carbon::parse($request->input('tansaction_date'));
            // Format the Carbon date as a string in the required format
            $data['tansaction_date'] = $tansactionDate->format('Y-m-d H:i:s');

            $data['registration_id'] = $unique_reg_no;
            $data['register_by'] = $user->id;
            $savedData = Registration::Create($data);

            if($savedData) {
                $this->saveApplicant($savedData, $data);
                $this->saveOffender($savedData, $data);
                $this->saveNatureOfTransaction($savedData, $data);
                $this->savePurposeOfTransaction($savedData, $data);
                $this->saveProofOfTransaction($savedData, $data);

                History::create([
                    'description' => 'दर्ता- ' .$data['registration_id']. ' सिर्जना गरिएको छ। ' . $user->name,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
            }

            // return redirect()->back()->with('success', "दर्ता नम्बर  सिर्जना गरियेको छ।");
            return redirect()->back()->with('success', "दर्ता नम्बर {$unique_reg_no} सिर्जना गरिएको छ।");
        }catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Insert applicant.
     *
     * @param  \App\Models\Applicant
     * @return \Illuminate\Http\Response
     */
    public function saveApplicant($registration_record, $data)
    {
        if(isset($data['applicant']['full_name']) && count($data['applicant']['full_name'])>0){ 
            //delete any applicant associated to registration id
            $applicant = Applicant::where('registration_id', $registration_record->id)->delete();
            
            foreach($data['applicant']['full_name'] as $key => $value) {
                $dataready = array (
                    'registration_id' =>$registration_record->id,
                    'full_name' =>$data['applicant']['full_name'][$key],
                    'contact' =>$data['applicant']['contact'][$key],
                    'state_id' =>$data['applicant']['state_id'][$key],
                    'district_id' =>$data['applicant']['district_id'][$key],
                    'localbody_id' =>$data['applicant']['localbody_id'][$key],
                    'wada_id' =>$data['applicant']['wada_id'][$key],
                );

                $saved = Applicant::create($dataready);
            }
            return $saved;
        }
        
    }

    /**
     * Insert offender.
     *
     * @param  \App\Models\Offender
     * @return \Illuminate\Http\Response
     */
    public function saveOffender($registration_record, $data)
    {
        if(isset($data['offender']['full_name']) && count($data['offender']['full_name'])>0){
            //delete any Offender associated to registration id
            $Offender = Offender::where('registration_id', $registration_record->id)->delete();
             
            foreach($data['offender']['full_name'] as $key => $value) {
                
                $dataready = array (
                    'registration_id' =>$registration_record->id,
                    'full_name' =>$data['offender']['full_name'][$key],
                    'contact' =>$data['offender']['contact'][$key],
                    'state_id' =>$data['offender']['state_id'][$key],
                    'district_id' =>$data['offender']['district_id'][$key],
                    'localbody_id' =>$data['offender']['localbody_id'][$key],
                    'wada_id' =>$data['offender']['wada_id'][$key],
                );

                $saved = Offender::create($dataready);
            }
            return $saved;
        }
        
    }
    
    /**
     * Insert Nature of Transaction.
     *
     * @param  \App\Models\TransactionNature
     * @return \Illuminate\Http\Response
     */
    public function saveNatureOfTransaction($registration_record, $data)
    {
        if(isset($data['nature_id']) && count($data['nature_id'])>0){ 
            //delete any TransactionNature associated to registration id
            $transactionnature = TransactionNature::where('registration_id', $registration_record->id)->delete();
             
            foreach($data['nature_id'] as $key => $value) {
                $dataready = array (
                    'registration_id' =>$registration_record->id,
                    'nature_id' => $value,
                );
                $saved = TransactionNature::create($dataready);
            }

            return $saved;
        }
        
    }

     /**
     * Insert Nature of Transaction.
     *
     * @param  \App\Models\TransactionPurpose
     * @return \Illuminate\Http\Response
     */
    public function savePurposeOfTransaction($registration_record, $data)
    {
        if(isset($data['purpose_id']) && count($data['purpose_id'])>0) {
            //delete any TransactionPurpose associated to registration id
            $transactionpurpose = TransactionPurpose::where('registration_id', $registration_record->id)->delete();
             
            foreach($data['purpose_id'] as $key => $value) {
                $dataready = array (
                    'registration_id' =>$registration_record->id,
                    'purpose_id' => $value,
                );
                $saved = TransactionPurpose::create($dataready);
            }

            return $saved;
        }
        
    }
    
    /**
     * Insert Nature of Transaction.
     *
     * @param  \App\Models\TransactionProof
     * @return \Illuminate\Http\Response
     */
    public function saveProofOfTransaction($registration_record, $data)
    {
        if(isset($data['proof']['proof_id']) && count($data['proof']['proof_id'])>0){ 
            //delete any TransactionProof associated to registration id
            $transactionproof = TransactionProof::where('registration_id', $registration_record->id)->delete();
             
            foreach($data['proof']['proof_id'] as $key => $value) {
                
                $dataready = array (
                    'registration_id' =>$registration_record->id,
                    'proof_id' =>$data['proof']['proof_id'][$key],
                    'amount' =>$data['proof']['amount'][$key],
                );

                $saved = TransactionProof::create($dataready);
            }
            return $saved;
        }
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registration = Registration::find($id);
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $localgovs = LocalGovernment::select('name', 'id')->get();
        $states = State::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        $page_title = 'दर्ता फारम सम्पादन';
        return view('admin.registration.update', compact('registration','states', 'districts', 'localgovs', 'purposes', 'proofs', 'natures', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        
        $validatedData = $request->validate([
            'id' => 'required',
            'registration_id' => 'required',
            'transaction_amount' => 'required',
            'tansaction_date' => 'required|date',

            'applicant.full_name.*' => 'required',
            'applicant.contact.*' => 'required',
            'applicant.state_id.*' => 'required',
            'applicant.district_id.*' => 'required',
            'applicant.localbody_id.*' => 'required',
            'applicant.wada_id.*' => 'required',

            'offender.full_name.*' => 'required',
            'offender.contact.*' => 'required',
            'offender.state_id.*' => 'required',
            'offender.district_id.*' => 'required',
            'offender.localbody_id.*' => 'required',
            'offender.wada_id.*' => 'required',
            
            'proof.*' => 'required',
            'nature_id.*' => 'required',
            'purpose_id.*' => 'required',
        ]);
        try{
            //get registered user by id
            $registered = Registration::where('id', $validatedData['id'])->first();
            // Generate a unique reg_no based on user's name
            $user = Auth::user();
            $unique_reg_no = $user->district_id . '_' . $validatedData['registration_id'];

            // Check if the generated unique_registration_id is unique for the user
            $count = Registration::where('id', '!=', $registered->id)->where('registration_id', $unique_reg_no)->where('register_by', $user->id)->count();
            //dd($count);
            if ($count > 0) {

                return redirect()->back()->with('error', 'Registration Number Already Exist.');
            }

            $data = $request->all();
            $data['registration_id'] = $unique_reg_no;
            $data['register_by'] = $user->id;
            $savedData = $registered->update($data);
            if($savedData) {
                // dd($data);
                $this->saveApplicant($registered, $data);
                $this->saveOffender($registered, $data);
                $this->saveNatureOfTransaction($registered, $data);
                $this->savePurposeOfTransaction($registered, $data);
                $this->saveProofOfTransaction($registered, $data);

                History::create([
                    'description' => 'दर्ता- ' .$validatedData['registration_id']. ' सम्पादन गरिएको छ। ' . $user->name,
                    'user_id' => Auth::user()->id,
                    'type' => 1,
                    'ip_address' => UtilityFunctions::getUserIP(),
                ]);
            }

            return redirect()->back()->with('success', 'Registration Was Successfully Updated');
        }catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registration = Registration::find($id);
        $user = Auth::user();

        if (!$registration) {
            return redirect()->back()->with('error', 'Registration not found.');
        }
        //on delete of registration it deletes nature/proof/purpose of transaction as well as applicant and offender details associated with registration_id
        if($registration->delete()){
            History::create([
                'description' => 'दर्ता- ' .$registration->id. ' मेटैएको छ। ' . $user->name,
                'user_id' => Auth::user()->id,
                'type' => 1,
                'ip_address' => UtilityFunctions::getUserIP(),
            ]);
        };

        return redirect()->back()->with('success', 'Registration Deleted Successfully.');
    }

    //ajax call 
    public function getDistricts($state_id)
    {
        $districts = District::where('state_id', $state_id)->get();
        return response()->json($districts);
    }
    //ajax call 
    public function getLocalGovernments($district_id)
    {
        $localGovernments = LocalGovernment::where('district_id', $district_id)->get();
        return response()->json($localGovernments);
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllRegistration(Request $request)
    {
       $registrations = $this->getForDataTable($request->all());
    //    foreach($registrations->applicant as $applicant) {
    //     $full_name += $applicant->full_name;
    //    }
    //    dd($full_name);
        return Datatables::of($registrations)
        ->escapeColumns([])
        ->addColumn('applicant_full_name', function ($registration) {
            return $registration->applicant->pluck('full_name')->implode(', ');
        })
        ->addColumn('applicant_contact', function ($registration) {
            return $registration->applicant->pluck('contact')->implode(', ');
        })
        ->addColumn('offender_full_name', function ($registration) {
            return $registration->offender->pluck('full_name')->implode(', ');
        })
        ->addColumn('offender_contact', function ($registration) {
            return $registration->offender->pluck('contact')->implode(', ');
        })
        ->addColumn('register_by', function ($registration) {
            return $registration->user->name;
        })
        ->addColumn('tansaction_date', function ($registration) {
            return $registration->created_at->diffForHumans();
        })
        ->addColumn('created_at', function ($registration) {
            return $registration->created_at->diffForHumans();
        })
        //if view required add on action column
        // <a href="'.route('admin.registrations.show', $registrations->id).'" class="action-btn"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
        ->addColumn('actions', function ($registrations) {
            return '<a href="'.route('admin.registrations.edit', $registrations->id).'" class="btn btn-outline-primary btn-sm mx-1" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" ></i></a>
            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete'.$registrations->id.'"  data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
            <div class="modal fade" id="delete'.$registrations->id.'" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form method="POST" action="' . route('admin.registrations.destroy', $registrations->id) . '" accept-charset="UTF-8" method="POST">
                    <div class="modal-body">
                    
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="'.csrf_token().'">
                    
                      <p>Are you sure to delete <span id="underscore"> '.$registrations->name.' </span></p>
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

    // <div class="modal fade" id="'.$registrations->id.'" role="dialog">
    //             <div class="modal-dialog">
                
    //               <!-- Modal content-->
    //               <div class="modal-content">
    //                 <div class="modal-header">
    //                   <button type="button" class="close" data-dismiss="modal">&times;</button>
    //                   <h4 class="modal-title">User Delete</h4>
    //                 </div>
                    // <form method="POST" action="' . route('admin.registrations.destroy', $registrations->id) . '" accept-charset="UTF-8" method="POST">
                    // <div class="modal-body">
                    
                    //     <input name="_method" type="hidden" value="DELETE">
                    //     <input name="_token" type="hidden" value="'.csrf_token().'">
                    
                    //   <p>Are you sure to delete <span id="underscore"> '.$registrations->name.' </span></p>
                    // </div>
                    // <div class="modal-footer">
                    //   <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                    //   <button type="submit" class="btn btn-primary">Yes</button>
                    // </div>
                    // </form>
    //               </div>
                  
    //             </div>
    //           </div>
              
    //         </div>
    
    /**
     * Get all the required data
     *
     * @return Response
     */
    public function getForDataTable($request)
    {
        /**
         * Note: You must return deleted_at or the news getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = Registration::where(function ($query) use ($request) {
            if (isset($request->id)) {
                $query->where('id', $request->id);
                }
            })
            ->when(User::isAdmin(), function ($query) {

                return $query->where('register_by', Auth::user()->id);
            })
            ->get();

        return $dataTableQuery;
    }
}
