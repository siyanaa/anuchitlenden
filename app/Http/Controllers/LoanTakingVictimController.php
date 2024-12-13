<?php

namespace App\Http\Controllers;

use App\Models\Proof;
use App\Models\State;
use App\Models\District;
use App\Models\LocalGovernment;
use App\Models\Nature;
use App\Models\Purpose;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\LoanTakingVictim;
use App\Models\LoanTakingOpponentBasicDetail;
use App\Models\LoanTakingApplicantBasicDetail;
use App\Models\LoanTakingApplicationRegistration;
use App\Models\LoanTakingCourtDetail;
use App\Models\LoanTakingLoanDetail;
use App\Models\LoanTakingInterestDetail;
use App\Models\LoanTakingAdditionalDetail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class LoanTakingVictimController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            // $userId = Auth::id();
            // $data = LoanTakingVictim::with(['basicDetailRegistration', 'basicOpponentDetailRegistration', 'loanDetail'])
            // ->where('regsiter_by' , $userId)
            // ->latest()->get();
            $user = Auth::user();

           // Start building the query
           $query = LoanTakingVictim::with(['basicDetailRegistration', 'basicOpponentDetailRegistration', 'loanDetail']);

           // Apply filter if the user is not a superadmin or supersuperadmin
           if (!$user->isSuperAdmin() && !$user->isSuperSuperAdmin()) {
               $query->where('register_by', $user->id);
           }
   
           $data = $query->latest()->get();



            return DataTables::of($data)
                ->addColumn('applicant_name', function ($row) {
                    return $row->basicDetailRegistration->applicant_name ?? '';
                })
                ->addColumn('applicant_temp_local', function ($row) {
                    return $row->basicDetailRegistration->applicant_temp_local ?? '';
                })
                ->addColumn('applicant_occup', function ($row) {
                    return $row->basicDetailRegistration->applicant_occup ?? '';
                })
                ->addColumn('opponent_name', function ($row) {
                    return $row->basicOpponentDetailRegistration->opponent_name ?? '';
                })
                ->addColumn('loan_date', function ($row) {
                    return $row->loanDetail->loan_date ?? '';
                })
                ->addColumn('loan_location', function ($row) {
                    return $row->loanDetail->loan_location ?? '';
                })
                ->addColumn('loan_amount', function ($row) {
                    return $row->loanDetail->loan_amount ?? '';
                })
                ->addColumn('loan_medium', function ($row) {
                    return $row->loanDetail->loan_medium ?? '';
                })
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('admin.loantaking-victim.show', $row->id) . '" class="btn btn-primary btn-sm">Show</a>
                            <a href="' . route('admin.loantaking-victim.edit', $row->id) . '" class="btn btn-info btn-sm">Edit</a>
                            <form action="' . route('admin.loantaking-victim.destroy', $row->id) . '" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.LoanTakingVictim.index');
    }



    public function getForDataTable($request)
    {
        /**
         * Note: You must return deleted_at or the news getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = LoanTakingVictim::where(function ($query) use ($request) {
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



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $locals = LocalGovernment::select('name', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        $loanTakingVictim = LoanTakingVictim::all();
        $page_title = 'अनुचित लेनदेन (मिटरब्याज) सम्बन्धी  पीडितले भर्ने निवेदन फाराम : १
        ';
        $user = Auth::user();
        return view('admin.LoanTakingVictim.create', compact('page_title', 'states', 'natures', 'proofs', 'purposes', 'loanTakingVictim','districts','locals', 'user'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'loan_taking_application_registration.registration_id' => 'string|max:255',
            'loan_taking_application_registration.registration_date' => 'max:255',
            'loan_taking_application_registration.registration_office' => 'string|max:255',

        ]);
        if ($request->has('loan_taking_application_registration')) {
            $registrationData = $validatedData['loan_taking_application_registration'];
            $registration = LoanTakingApplicationRegistration::create([
                'registration_id' => $registrationData['registration_id'],
                'registration_date' => $registrationData['registration_date'],
                'registration_office' => $registrationData['registration_office'],
            ]);
        } else {
            return redirect()->back()->with('error', 'Registration details are missing.');
        }

        $validateRegisterData = $request->validate([

            'loan_taking_applicant_basic_detail.applicant_name' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_age' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_citizenship' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_citizenship_issue_district' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_citizenship_issue_date' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_fathername' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_fathers_no' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_spouse' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_spouse_no' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_family' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_annual_income' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_permanent_state' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_permanent_district' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_permanent_local' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_permanent_ward' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_temp_state' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_temp_district' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_temp_local' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_temp_ward' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_pan' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_occup' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_edu' => 'nullable|string|max:255',

        ]);

        if ($request->has('loan_taking_applicant_basic_detail')) {
            $basicDetailsData = $validateRegisterData['loan_taking_applicant_basic_detail'];
            $loanDetailBasic = LoanTakingApplicantBasicDetail::create([
                'applicant_name' => $basicDetailsData['applicant_name'],
                'applicant_age' => $basicDetailsData['applicant_age'] ?? null,
                'applicant_citizenship' => $basicDetailsData['applicant_citizenship'] ?? null,
                'applicant_citizenship_issue_district' => $basicDetailsData['applicant_citizenship_issue_district'] ?? null,
                'applicant_citizenship_issue_date' => $basicDetailsData['applicant_citizenship_issue_date'] ?? null,
                'applicant_fathername' => $basicDetailsData['applicant_fathername'],
                'applicant_fathers_no' => $basicDetailsData['applicant_fathers_no'],
                'applicant_spouse' => $basicDetailsData['applicant_spouse'] ?? null,
                'applicant_spouse_no' => $basicDetailsData['applicant_spouse_no'] ?? null,
                'applicant_family' => $basicDetailsData['applicant_family'],
                'applicant_annual_income' => $basicDetailsData['applicant_annual_income'],
                'applicant_permanent_state' => $basicDetailsData['applicant_permanent_state'],
                'applicant_permanent_district' => $basicDetailsData['applicant_permanent_district'],
                'applicant_permanent_local' => $basicDetailsData['applicant_permanent_local'],
                'applicant_permanent_ward' => $basicDetailsData['applicant_permanent_ward'],
                'applicant_temp_state' => $basicDetailsData['applicant_temp_state'],
                'applicant_temp_district' => $basicDetailsData['applicant_temp_district'],
                'applicant_temp_local' => $basicDetailsData['applicant_temp_local'],
                'applicant_temp_ward' => $basicDetailsData['applicant_temp_ward'],
                'applicant_pan' => $basicDetailsData['applicant_pan'] ?? null,
                'applicant_occup' => $basicDetailsData['applicant_occup'] ?? null,
                'applicant_edu' => $basicDetailsData['applicant_edu'] ?? null,
            ]);
        }

        $validateRegisterOpponentData = $request->validate([
            'loan_taking_opponent_detail.opponent_name' => 'required|string|max:255',
            'loan_taking_opponent_detail.opponent_age' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_fathername' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_fathers_no' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_spouse' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_spouse_no' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_permanent_state' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_permanent_district' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_permanent_local' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_permanent_ward' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_temp_state' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_temp_district' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_temp_local' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_temp_ward' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_occupation' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_education_level' => 'nullable|string|max:255',
        ]);

        if ($request->has('loan_taking_opponent_detail')) {
            $basicOpponentDetailsData = $validateRegisterOpponentData['loan_taking_opponent_detail'];
            $loanDetailOpponentBasic = LoanTakingOpponentBasicDetail::create([
                'opponent_name' => $basicOpponentDetailsData['opponent_name'],
                'opponent_age' => $basicOpponentDetailsData['opponent_age'] ?? null,
                'opponent_fathername' => $basicOpponentDetailsData['opponent_fathername'] ?? null,
                'opponent_fathers_no' => $basicOpponentDetailsData['opponent_fathers_no'] ?? null,
                'opponent_spouse' => $basicOpponentDetailsData['opponent_spouse'] ?? null,
                'opponent_spouse_no' => $basicOpponentDetailsData['opponent_spouse_no'] ?? null,
                'opponent_permanent_state' => $basicOpponentDetailsData['opponent_permanent_state'] ?? null,
                'opponent_permanent_district' => $basicOpponentDetailsData['opponent_permanent_district'] ?? null,
                'opponent_permanent_local' => $basicOpponentDetailsData['opponent_permanent_local'] ?? null,
                'opponent_permanent_ward' => $basicOpponentDetailsData['opponent_permanent_ward'] ?? null,
                'opponent_temp_state' => $basicOpponentDetailsData['opponent_temp_state'] ?? null,
                'opponent_temp_district' => $basicOpponentDetailsData['opponent_temp_district'] ?? null,
                'opponent_temp_local' => $basicOpponentDetailsData['opponent_temp_local'] ?? null,
                'opponent_temp_ward' => $basicOpponentDetailsData['opponent_temp_ward'] ?? null,
                'opponent_occupation' => $basicOpponentDetailsData['opponent_occupation'] ?? null,
                'opponent_education_level' => $basicOpponentDetailsData['opponent_education_level'] ?? null,

            ]);
        }

        // FOR LOAN
        $validateLoanDetailData = $request->validate([
            'loan_taking_loan_detail.loan_purpose' => 'required|array|max:255',
            'loan_taking_loan_detail.loan_purpose.*' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_date' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_location' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_amount' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_witness.*' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_witness' => 'required|array|max:255',
            'loan_taking_loan_detail.loan_docs_write' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_docs_address' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_medium.*' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_medium' => 'required|array|max:255',
            'loan_taking_loan_detail.is_loan_docs' => 'required|string|max:255',
            'loan_taking_loan_detail.is_loan_same' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_tamasuk_amount' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_transaction_actual_amount' => 'required|string|max:255',
            'loan_taking_loan_detail.is_taken_loan_stamp' => 'required|string|max:255',
            'loan_taking_loan_detail.taken_loan_stamp_amount' => 'required|string|max:255',
            'loan_taking_loan_detail.is_written_tamsuk_changed' => 'required|string|max:255',
            'loan_taking_loan_detail.is_land_return_promise' => 'required|string|max:255',
            'loan_taking_loan_detail.is_other_return_promise' => 'required|string|max:255',
            'loan_taking_loan_detail.land_used_by_name' => 'nullable|string|max:255',
            'loan_taking_loan_detail.land_used_by_address' => 'nullable|string|max:255',
            'loan_taking_loan_detail.is_land_stop_promise' => 'required|boolean',
            'loan_taking_loan_detail.land_stop_promise_state' => 'required_if:loan_taking_loan_detail.is_land_stop_promise,1|nullable',
            'loan_taking_loan_detail.land_stop_promise_used_by_name' => 'nullable|string|max:255',
            'loan_taking_loan_detail.land_stop_promise_used_by_address' => 'nullable|string|max:255',
            'loan_taking_loan_detail.is_witness_any_promise' => 'required|boolean',
            'loan_taking_loan_detail.witness_any_promise_state' => 'required_if:loan_taking_loan_detail.is_witness_any_promise,1|nullable',
            'loan_taking_loan_detail.land_stop_promise_who_name' => 'required|string|max:255',
            'loan_taking_loan_detail.land_rights_possessed_by_whome' => 'required|string|max:255',
        ]);
        if ($request->has('loan_taking_loan_detail')) {
            $loanDetailsData = $validateLoanDetailData['loan_taking_loan_detail'];
            $loanDetails = LoanTakingLoanDetail::create([
                'loan_purpose' => implode(',', $loanDetailsData['loan_purpose']),
                'loan_date' => $loanDetailsData['loan_date'],
                'loan_location' => $loanDetailsData['loan_location'],
                'loan_amount' => $loanDetailsData['loan_amount'],
                'loan_witness' => implode(',', $loanDetailsData['loan_witness']) ?? '',
                'loan_docs_write' => $loanDetailsData['loan_docs_write'],
                'loan_docs_address' => $loanDetailsData['loan_docs_address'],
                'loan_medium' => implode(',', $loanDetailsData['loan_medium']) ?? '',
                'is_loan_docs' => $loanDetailsData['is_loan_docs'],
                'is_loan_same' => $loanDetailsData['is_loan_same'],
                'loan_tamasuk_amount' => $loanDetailsData['loan_tamasuk_amount'],
                'loan_transaction_actual_amount' => $loanDetailsData['loan_transaction_actual_amount'],
                'is_taken_loan_stamp' => $loanDetailsData['is_taken_loan_stamp'],
                'taken_loan_stamp_amount' => $loanDetailsData['taken_loan_stamp_amount'],
                'is_written_tamsuk_changed' => $loanDetailsData['is_written_tamsuk_changed'],
                'is_land_return_promise' => $loanDetailsData['is_land_return_promise'],
                'is_other_return_promise' => $loanDetailsData['is_other_return_promise'],
                'land_used_by_name' => $loanDetailsData['land_used_by_name'] ?? null,
                'land_used_by_address' => $loanDetailsData['land_used_by_address'] ?? null,
                'is_land_stop_promise' => $loanDetailsData['is_land_stop_promise'],
                'land_stop_promise_state' => $loanDetailsData['land_stop_promise_state'] ?? null,
                'land_stop_promise_used_by_name' => $loanDetailsData['land_stop_promise_used_by_name'] ?? null,
                'land_stop_promise_used_by_address' => $loanDetailsData['land_stop_promise_used_by_address'] ?? null,
                'is_witness_any_promise' => $loanDetailsData['is_witness_any_promise'],
                'witness_any_promise_state' => $loanDetailsData['witness_any_promise_state'] ?? null,
                'land_stop_promise_who_name' => $loanDetailsData['land_stop_promise_who_name'],
                'land_rights_possessed_by_whome' => $loanDetailsData['land_rights_possessed_by_whome'],
            ]);
        }

        //For interest

        $validateInterestDetailData = $request->validate([
            'loan_taking_interest_detail.written_docs_interest_rate' => 'required|string|max:255',
            'loan_taking_interest_detail.written_docs_given_interest_rate' => 'required|string|max:255',
            'loan_taking_interest_detail.till_now_interest_amount' => 'required|string|max:255',
            'loan_taking_interest_detail.interest_paid_medium' => 'required|array|max:255',
            'loan_taking_interest_detail.interest_paid_medium.*' => 'required|string|max:255',
            'loan_taking_interest_detail.till_now_paid_capital' => 'required|string|max:255',
            'loan_taking_interest_detail.till_now_to_be_paid_amount' => 'required|string|max:255',
            'loan_taking_interest_detail.is_registered_inward' => 'required|boolean|max:255',
            'loan_taking_interest_detail.registered_no' => 'required_if:loan_taking_interest_detail.is_registered_inward,1|nullable',
            'loan_taking_interest_detail.loan_amount_pay_last_date' => 'required|string|max:255',
        ]);

        if ($request->has('loan_taking_interest_detail')) {
            $interestDetailsData = $validateInterestDetailData['loan_taking_interest_detail'];
            $interestDetails = LoanTakingInterestDetail::create([
                'written_docs_interest_rate' => $interestDetailsData['written_docs_interest_rate'],
                'written_docs_given_interest_rate' => $interestDetailsData['written_docs_given_interest_rate'],
                'till_now_interest_amount' => $interestDetailsData['till_now_interest_amount'],
                'interest_paid_medium' => implode(',', $interestDetailsData['interest_paid_medium']) ?? '',
                // 'interest_paid_medium' => $interestDetailsData['interest_paid_medium'],
                'till_now_paid_capital' => $interestDetailsData['till_now_paid_capital'],
                'till_now_to_be_paid_amount' => $interestDetailsData['till_now_to_be_paid_amount'],
                'is_registered_inward' => $interestDetailsData['is_registered_inward'],
                'registered_no' => $interestDetailsData['registered_no'] ?? null,
                'loan_amount_pay_last_date' => $interestDetailsData['loan_amount_pay_last_date'],

            ]);
        }

        // FOR COURT
       $validateCourtDetailData = $request->validate([
        'loan_taking_court_detail.is_issue_in_court' => 'required|boolean|max:255',
        'loan_taking_court_detail.issue_in_court_result' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.issue_in_court_subject' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.issue_in_court_subject_no' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.is_issue_in_court_applicant_asset_collapse' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.applicant_collapse_by_who_name' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.applicant_collapse_by_who_address' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.is_application_decision_jailtime' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.is_jail_subjected' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.if_in_jail_start_date' => 'required_if:loan_taking_court_detail.is_jail_subjected,1|nullable',
        'loan_taking_court_detail.if_in_jail_start_duration' => 'required_if:loan_taking_court_detail.is_jail_subjected,1|nullable',
        'loan_taking_court_detail.is_cheque_bounce_case' => 'required|boolean|max:255',
        'loan_taking_court_detail.cheque_bounce_case_result' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
        'loan_taking_court_detail.if_bank_cheque_case_resulted' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
        'loan_taking_court_detail.case_result_bigo' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
        'loan_taking_court_detail.case_result_fine' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
        'loan_taking_court_detail.case_result_jail' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
        
    ]);
     if ($request->has('loan_taking_court_detail')) {
        $courtDetailsData = $validateCourtDetailData['loan_taking_court_detail'];
        $courtDetails = LoanTakingCourtDetail::Create([
            'is_issue_in_court' => $courtDetailsData['is_issue_in_court'],
            'issue_in_court_result' => $courtDetailsData['issue_in_court_result'] ?? null,
            'issue_in_court_subject' => $courtDetailsData['issue_in_court_subject'] ?? null,
            'issue_in_court_subject_no' => $courtDetailsData['issue_in_court_subject_no'] ?? null,
            'is_issue_in_court_applicant_asset_collapse' => $courtDetailsData['is_issue_in_court_applicant_asset_collapse'] ?? null,
            'applicant_collapse_by_who_name' => $courtDetailsData['applicant_collapse_by_who_name'] ?? null,
            'applicant_collapse_by_who_address' => $courtDetailsData['applicant_collapse_by_who_address'] ?? null,
            'is_application_decision_jailtime' => $courtDetailsData['is_application_decision_jailtime'] ?? null,
            'is_jail_subjected' => $courtDetailsData['is_jail_subjected'] ?? null,
            'if_in_jail_start_date' => $courtDetailsData['if_in_jail_start_date'] ?? null,
            'if_in_jail_start_duration' => $courtDetailsData['if_in_jail_start_duration'] ?? null,
            'is_cheque_bounce_case' => $courtDetailsData['is_cheque_bounce_case'],
            'cheque_bounce_case_result' => $courtDetailsData['cheque_bounce_case_result'] ?? null,
            'if_bank_cheque_case_resulted' => $courtDetailsData['if_bank_cheque_case_resulted'] ?? null,
            'case_result_bigo' => $courtDetailsData['case_result_bigo'] ?? null,
            'case_result_fine' => $courtDetailsData['case_result_fine'] ?? null,
            'case_result_jail' => $courtDetailsData['case_result_jail'] ?? null,
        ]
    );
}
      
        //FOR ADDTIIONAL DETAIL

        $validateAdditionalDetailData = $request->validate([
            'loan_taking_additional_detail.applicant_house_no' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_area'=> 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_area.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_type' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_type.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_storeyed' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_storeyed.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_state' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_state.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_district' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_district.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_local' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_local.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_ward' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_ward.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_kitta_no' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_kitta_no.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_area' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_area.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_state' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_state.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_district' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_district.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_local' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_local.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_ward' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_ward.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_vehicle_details' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_current_asset_details' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_org_name' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_finance_org_branch' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_account_opening_date' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_finance_amount' => 'required|string|max:255',
            'loan_taking_additional_detail.transaction_actual_interest' => 'nullable|string|max:255',
            'loan_taking_additional_detail.other_details_in_transaction' => 'nullable|string|max:255',
            'loan_taking_additional_detail.application_verifying_document' => 'nullable|array|max:255',
            'loan_taking_additional_detail.application_verifying_document.*' => 'nullable|string|max:255',
            'loan_taking_additional_detail.application_document_file' => 'nullable|array',
            'loan_taking_additional_detail.application_document_file.*' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif2|max:3000',
            'loan_taking_additional_detail.is_crime_reported' => 'nullable|boolean|max:255',
            'loan_taking_additional_detail.if_crime_reported' => 'required_if:loan_taking_additional_detail.is_crime_reported,1|nullable',
            'loan_taking_additional_detail.stamp_person_name' => 'nullable|string|max:255',
            'loan_taking_additional_detail.stamp_person_signature' => 'nullable|string|max:255',
            'loan_taking_additional_detail.stamp_date' => 'nullable|string|max:255',


        ]);

        if ($request->has('loan_taking_additional_detail')) {
            $additionalDetailsData = $validateAdditionalDetailData['loan_taking_additional_detail'];
            $additionalDetails = LoanTakingAdditionalDetail::create([
                'applicant_house_no' => $additionalDetailsData['applicant_house_no'],
                'applicant_house_area' =>  implode(',', $additionalDetailsData['applicant_house_area']),
                'applicant_house_type' =>  implode(',',$additionalDetailsData['applicant_house_type']),
                'applicant_house_storeyed' =>  implode(',', $additionalDetailsData['applicant_house_storeyed']),
                'applicant_house_state' => implode(',', $additionalDetailsData['applicant_house_state']) ?? '',
                'applicant_house_district' => implode(',', $additionalDetailsData['applicant_house_district']),
                'applicant_house_local' => implode(',', $additionalDetailsData['applicant_house_local']),
                'applicant_house_ward' => implode(',', $additionalDetailsData['applicant_house_ward']),
                'applicant_land_kitta_no' => implode(',', $additionalDetailsData['applicant_land_kitta_no']),
                'applicant_land_area' => implode(',', $additionalDetailsData['applicant_land_area']),
                'applicant_land_state' => implode(',', $additionalDetailsData['applicant_land_state']),
                'applicant_land_district' => implode(',', $additionalDetailsData['applicant_land_district']),
                'applicant_land_local' => implode(',', $additionalDetailsData['applicant_land_local']),
                'applicant_land_ward' => implode(',', $additionalDetailsData['applicant_land_ward']),
                'applicant_vehicle_details' => $additionalDetailsData['applicant_vehicle_details'],
                'applicant_current_asset_details' => $additionalDetailsData['applicant_current_asset_details'],
                'applicant_org_name' => $additionalDetailsData['applicant_org_name'],
                'applicant_finance_org_branch' => $additionalDetailsData['applicant_finance_org_branch'],
                'applicant_account_opening_date' => $additionalDetailsData['applicant_account_opening_date'],
                'applicant_finance_amount' => $additionalDetailsData['applicant_finance_amount'],
                'is_crime_reported' => $additionalDetailsData['is_crime_reported'] ?? null,
                'if_crime_reported' => $additionalDetailsData['if_crime_reported'] ?? null,
                'transaction_actual_interest' => $additionalDetailsData['transaction_actual_interest'] ?? null,
                'application_verifying_document' => implode(',', $additionalDetailsData['application_verifying_document']) ?? null,
                'application_document_file' => isset($additionalDetailsData['application_document_file']) ? implode(',', $additionalDetailsData['application_document_file']) : null,
                'stamp_person_name' => $additionalDetailsData['stamp_person_name'] ?? null,
                'stamp_person_signature' => $additionalDetailsData['stamp_person_signature'] ?? null,
                'stamp_date' => $additionalDetailsData['stamp_date'] ?? null,


            ]);
        }
        $loanTakingVictim = loanTakingVictim::create([
            'registration_id' => $registration->id,
            'basic_detail_id' => $loanDetailBasic->id,
            'opponent_detail_id' => $loanDetailOpponentBasic->id,
            'loan_detail_id' => $loanDetails->id,
            'court_detail_id' => $courtDetails->id,
            'interest_detail_id' => $interestDetails->id,
            'additional_detail_id' => $additionalDetails->id,
        ]);
        return redirect()->route('admin.loantaking-victim.index')->with('success', 'Data saved successfully.');
    }



    public function show(loanTakingVictim $loanGivingVictim,$id)
    {
        $loanTakingVictim = LoanTakingVictim::findOrFail($id);
        $states = State::select('id', 'name')->get();
        $districts = District::select('id', 'name')->get();
        $purposes = Purpose::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
      
        $interestChanges = LoanTakingInterestDetail::findOrFail($id);
        $previouslyStoredValue = $interestChanges->is_registered_inward; //radiobutton


        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_issue_in_court;

        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_issue_in_court_applicant_asset_collapse;

        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_application_decision_jailtime;

        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_jail_subjected;


        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_cheque_bounce_case;

        $tamsukChanges = LoanTakingLoanDetail::findOrFail($id);
        $previouslyStoredValue = $tamsukChanges->is_written_tamsuk_changed;
        $previouslyStoredValueForLandReturn = $tamsukChanges->is_land_return_promise;
        $previouslyStoredValueForOtherReturnPromise = $tamsukChanges->is_other_return_promise;
        $previouslyStoredValueForLandStopPromise = $tamsukChanges->is_land_stop_promise;
        $previouslyStoredValueForLoanDocs = $tamsukChanges->is_loan_docs;
        $previouslyStoredValueForLoanSame = $tamsukChanges->is_loan_same;
        $previouslyStoredValueForWitnessAnyPromise = $tamsukChanges->is_witness_any_promise;
        $previouslyStoredValueForLoanStamp = $tamsukChanges->is_taken_loan_stamp;
        $previouslyStoredValuesPurpose = is_array($tamsukChanges->loan_purpose) ? $tamsukChanges->loan_purpose : explode(',', $tamsukChanges->loan_purpose);
        $previouslyStoredValuesProof = is_array($tamsukChanges->loan_medium) ? $tamsukChanges->loan_medium : explode(',', $tamsukChanges->loan_medium);
        
        $housetypes = [
            'कच्ची',
            'पक्की',
            'अन्य',
        ];

        $land_stop_promise_who_name = [
            'निवेदक',
            'विपक्षी',
            'अन्य',

        ];

        $results = [
            'विचाराधीन अवस्थामा रहेको',
            'फैसला भई फैसला कार्यान्वयन हुन बाँकी रहेको',
            'फैसला भई फैसला कार्यान्वयन भई सकेको',
        ];
        $loanDetails = LoanTakingLoanDetail::find($id);
        $loanMedium = json_decode($loanDetails->loan_medium, true);

        $interestMedium = json_decode($interestChanges->interest_paid_medium, true);

        $loanTakingAditionalVictim = LoanTakingVictim::with('additionalDetail')->find($id);

        // dd($loanDetails);
        return view('admin.LoanTakingVictim.show', compact(
            'states',
            'loanTakingVictim',
            'previouslyStoredValue',
            'previouslyStoredValueForLandReturn',
            'previouslyStoredValueForOtherReturnPromise',
            'previouslyStoredValueForLandStopPromise',
            'previouslyStoredValueForLoanDocs',
            'previouslyStoredValueForLoanSame',
            'previouslyStoredValueForWitnessAnyPromise',
            'previouslyStoredValueForLoanStamp',
            'previouslyStoredValuesPurpose',
            'loanTakingVictim',
            'previouslyStoredValue',
            'previouslyStoredCourtValue',
            'purposes',
            'proofs',
            'previouslyStoredValuesProof',
            'housetypes',
            'land_stop_promise_who_name',
            'results',
            'districts',
            'loanDetails',
           'interestChanges',
           'loanTakingAditionalVictim'
        ));

    }




    public function edit(LoanTakingVictim $loanTakingVictim, $id)
    {
        $page_title = "LOAN TAKING";
        $loanTakingVictim = LoanTakingVictim::findOrFail($id);
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $locals = LocalGovernment::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();


        $loanTakingVictim = LoanTakingVictim::findOrFail($id);
        // FOR RADIO BUTTON
        $tamsukChanges = LoanTakingLoanDetail::findOrFail($id);
        $previouslyStoredValue = $tamsukChanges->is_written_tamsuk_changed;
        $previouslyStoredValueForLandReturn = $tamsukChanges->is_land_return_promise;
        $previouslyStoredValueForOtherReturnPromise = $tamsukChanges->is_other_return_promise;
        $previouslyStoredValueForLandStopPromise = $tamsukChanges->is_land_stop_promise;
        $previouslyStoredValueForLoanDocs = $tamsukChanges->is_loan_docs;
        $previouslyStoredValueForLoanSame = $tamsukChanges->is_loan_same;
        $previouslyStoredValueForWitnessAnyPromise = $tamsukChanges->is_witness_any_promise;
        $previouslyStoredValueForLoanStamp = $tamsukChanges->is_taken_loan_stamp;
        $previouslyStoredValuesPurpose = is_array($tamsukChanges->loan_purpose) ? $tamsukChanges->loan_purpose : explode(',', $tamsukChanges->loan_purpose);
        $previouslyStoredValuesProof = is_array($tamsukChanges->loan_medium) ? $tamsukChanges->loan_medium : explode(',', $tamsukChanges->loan_medium);

        $land_stop_promise_who_name = [
            'निवेदक',
            'विपक्षी',
            'अन्य व्यक्ति',

        ];

        $wards = range(1, 32);

        $incomes=[
            '१ लाख देखि  ५ लाख',
            '५ लाख to देखि १० लाख',
            '१० लाख देखि  २० लाख',
            '२० लाख +',
        ];

        $educationLevels = [
            'सामान्य लेखपढ',
            'कक्षा ८ सम्म',
            'कक्षा १० सम्म',
            'कक्षा १२ सम्म',
            'उच्च शिक्षा',
        ];
        $occupations=[
            'शिक्षक',
            'अभियंता',
            'डॉक्टर',
            'वकील',
            'व्यवसाय',
            'किसान',
            'अन्य',
        ];
        // FOR RADIO BUTTON
        $interestChanges = LoanTakingInterestDetail::findOrFail($id);
        $previouslyStoredValue = $interestChanges->is_registered_inward; //radiobutton


        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_issue_in_court;

        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_issue_in_court_applicant_asset_collapse;

        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_application_decision_jailtime;

        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_jail_subjected;


        $courtChanges = LoanTakingCourtDetail::findOrFail($id);
        $previouslyStoredCourtValue = $courtChanges->is_cheque_bounce_case;


        $checkdetails = [
            'मुद्दा विचाराधीन अवस्थामा रहेको',
            'विगो भराउने र जरिवाना मात्र भएको',
            'फैसलाले विगो भराएर कैद समेत हुने ठहराएको',
            'फैसलाले विगो भराएर जरिवाना हुने ठहराएको',
            'फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको',
            'सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला भएको',
            'सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला नभएको',

        ];

        $results = [
            'मुद्दा विचाराधीन अवस्थामा रहेको',
            'फैसला भई फैसला कार्यान्वयन हुन बाँकी रहेको',
            'फैसला भई फैसला कार्यान्वयन भई सकेको',
        ];

        $housetypes = [
            'कच्ची',
            'पक्की',
            'अन्य',
        ];

        $chequebouncecaseresults=[
            'विचाराधीन अवस्थामा रहेको',
            'विगो भराउने र जरिवाना मात्र भएको',
            'फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छ',
            ' फैसलाले विगो भराएर जरिवाना र कैद समेत हुने ठहराएको छैन',
            'सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला भएको',
            'सो बैंङ्ग कसुर/चेक अनादर मुद्दाको फैसला नभएको',
        ];

        $applicationVerifyingDocuments = optional($loanTakingVictim->additionalDetail)->application_verifying_document;
        $documentsArray = explode(',', $applicationVerifyingDocuments);

        $loanTakingAdditionalDetail = LoanTakingAdditionalDetail::findOrFail($id);
        $previouslyStoredCrimeValue = $loanTakingAdditionalDetail->is_crime_reported;

        $loanTakingApplicantBasicDetail= LoanTakingApplicantBasicDetail::findOrFail($id);

        $loanWitness = optional($loanTakingVictim->loanDetail)->loan_witness;
        $witnessArray = explode(',', $loanWitness);

        $loanTakingLoanDetail = LoanTakingLoanDetail::findOrFail($id);
        $loanPurposes = $loanTakingLoanDetail->loan_purpose ? explode(',', $loanTakingLoanDetail->loan_purpose) : [];


        
        $loanMediumsArray =  $loanTakingLoanDetail->loan_medium ? explode(',', $loanTakingLoanDetail->loan_medium) : [];

        $loanTakingInterestDetail = LoanTakingInterestDetail::findOrFail($id);
        $interestMediumsArray =  $loanTakingInterestDetail->interest_paid_medium ? explode(',', $loanTakingInterestDetail->interest_paid_medium) : [];

        return view('admin.LoanTakingVictim.update', compact(
            'page_title',
            'states',
            'natures',
            'proofs',
            'purposes',
            'loanTakingVictim',
            'previouslyStoredValue',
            'previouslyStoredValueForLandReturn',
            'previouslyStoredValueForOtherReturnPromise',
            'previouslyStoredValueForLandStopPromise',
            'previouslyStoredValueForLoanDocs',
            'previouslyStoredValueForLoanSame',
            'previouslyStoredValueForWitnessAnyPromise',
            'land_stop_promise_who_name',
            'previouslyStoredValueForLoanStamp',
            'previouslyStoredValuesPurpose',
            'districts',
            'locals',
            'wards',
            'educationLevels',
            'previouslyStoredCourtValue',
            'checkdetails',
            'results',
            'housetypes',
            'documentsArray',
            'witnessArray',
            'loanTakingAdditionalDetail',
            'previouslyStoredValuesProof',
            'previouslyStoredCrimeValue',
            'occupations',
            'loanPurposes',
            'loanTakingLoanDetail',
            'loanMediumsArray',
            'interestMediumsArray',
            'incomes',
            'chequebouncecaseresults',
            'loanTakingApplicantBasicDetail'



        ));
    }

    public function update(Request $request, $id)
    {

         // dd($request->all());
         try {
            // Validate the incoming request data for registration details
            $validatedRegistrationData = $request->validate([
            'loan_taking_application_registration.registration_id' => 'string|max:255',
            'loan_taking_application_registration.registration_date' => 'string|max:255',
            'loan_taking_application_registration.registration_office' => 'string|max:255',

            ]);
    
            // Find the existing registration record using the provided ID
            $registration = LoanTakingApplicationRegistration::findOrFail($id);
    
            // Update registration details
            $registration->update([
                'registration_id' => $validatedRegistrationData['loan_taking_application_registration']['registration_id'],
                'registration_date' => $validatedRegistrationData['loan_taking_application_registration']['registration_date'],
                'registration_office' => $validatedRegistrationData['loan_taking_application_registration']['registration_office'],
            ]);

        //FOR BASIC DETAIL
        $validateBasicDetailData = $request->validate([
            'loan_taking_applicant_basic_detail.applicant_name' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_age' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_citizenship' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_citizenship_issue_district' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_citizenship_issue_date' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_fathername' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_fathers_no' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_spouse' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_spouse_no' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_family' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_annual_income' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_permanent_state' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_permanent_district' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_permanent_local' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_permanent_ward' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_temp_state' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_temp_district' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_temp_local' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_temp_ward' => 'required|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_pan' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_occup' => 'nullable|string|max:255',
            'loan_taking_applicant_basic_detail.applicant_edu' => 'nullable|string|max:255',

        ]);
        
        if ($request->has('loan_taking_applicant_basic_detail')) {
            $basicDetailsData = $request->input('loan_taking_applicant_basic_detail');
        
            $basicDetail = LoanTakingApplicantBasicDetail::updateOrCreate(
                ['id' => $id], 
                [
                    'applicant_name' => $basicDetailsData['applicant_name'],
                'applicant_age' => $basicDetailsData['applicant_age'] ?? null,
                'applicant_citizenship' => $basicDetailsData['applicant_citizenship'] ?? null,
                'applicant_citizenship_issue_district' => $basicDetailsData['applicant_citizenship_issue_district'] ?? null,
                'applicant_citizenship_issue_date' => $basicDetailsData['applicant_citizenship_issue_date'] ?? null,
                'applicant_fathername' => $basicDetailsData['applicant_fathername'],
                'applicant_fathers_no' => $basicDetailsData['applicant_fathers_no'],
                'applicant_spouse' => $basicDetailsData['applicant_spouse'] ?? null,
                'applicant_spouse_no' => $basicDetailsData['applicant_spouse_no'] ?? null,
                'applicant_family' => $basicDetailsData['applicant_family'],
                'applicant_annual_income' => $basicDetailsData['applicant_annual_income'],
                'applicant_permanent_state' => $basicDetailsData['applicant_permanent_state'],
                'applicant_permanent_district' => $basicDetailsData['applicant_permanent_district'],
                'applicant_permanent_local' => $basicDetailsData['applicant_permanent_local'],
                'applicant_permanent_ward' => $basicDetailsData['applicant_permanent_ward'],
                'applicant_temp_state' => $basicDetailsData['applicant_temp_state'],
                'applicant_temp_district' => $basicDetailsData['applicant_temp_district'],
                'applicant_temp_local' => $basicDetailsData['applicant_temp_local'],
                'applicant_temp_ward' => $basicDetailsData['applicant_temp_ward'],
                'applicant_pan' => $basicDetailsData['applicant_pan'] ?? null,
                'applicant_occup' => $basicDetailsData['applicant_occup'] ?? null,
                'applicant_edu' => $basicDetailsData['applicant_edu'] ?? null,

                ]
            );
        }

        //for loan_taking_opponent_detail

        $validateRegisterOpponentData = $request->validate([
            'loan_taking_opponent_detail.opponent_name' => 'required|string|max:255',
            'loan_taking_opponent_detail.opponent_age' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_fathername' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_fathers_no' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_spouse' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_spouse_no' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_permanent_state' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_permanent_district' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_permanent_local' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_permanent_ward' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_temp_state' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_temp_district' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_temp_local' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_temp_ward' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_occupation' => 'nullable|string|max:255',
            'loan_taking_opponent_detail.opponent_education_level' => 'nullable|string|max:255',

        ]);
        
        // if (isset($validateRegisterOpponentData['opponent_name'])) {
            if ($request->has('loan_taking_opponent_detail')) {
                $opponentDetailsData = $request->input('loan_taking_opponent_detail');
            
                $opponentDetail = LoanTakingOpponentBasicDetail::updateOrCreate(
                    ['id' => $id], 
                    [
                'opponent_name' => $opponentDetailsData['opponent_name'],
                'opponent_age' => $opponentDetailsData['opponent_age'] ?? null,
                'opponent_fathername' => $opponentDetailsData['opponent_fathername'] ?? null,
                'opponent_fathers_no' => $opponentDetailsData['opponent_fathers_no'] ?? null,
                'opponent_spouse' => $opponentDetailsData['opponent_spouse'] ?? null,
                'opponent_spouse_no' => $opponentDetailsData['opponent_spouse_no'] ?? null,
                'opponent_permanent_state' => $opponentDetailsData['opponent_permanent_state'] ?? null,
                'opponent_permanent_district' => $opponentDetailsData['opponent_permanent_district'] ?? null,
                'opponent_permanent_local' => $opponentDetailsData['opponent_permanent_local'] ?? null,
                'opponent_permanent_ward' => $opponentDetailsData['opponent_permanent_ward'] ?? null,
                'opponent_temp_state' => $opponentDetailsData['opponent_temp_state'] ?? null,
                'opponent_temp_district' => $opponentDetailsData['opponent_temp_district'] ?? null,
                'opponent_temp_local' => $opponentDetailsData['opponent_temp_local'] ?? null,
                'opponent_temp_ward' => $opponentDetailsData['opponent_temp_ward'] ?? null,
                'opponent_occupation' => $opponentDetailsData['opponent_occupation'] ?? null,
                'opponent_education_level' => $opponentDetailsData['opponent_education_level'] ?? null,
                    
            ]);
        }

        //for loan_taking_loan_detail
        $validateLoanDetailData = $request->validate([

            'loan_taking_loan_detail.loan_purpose' => 'required|array|max:255',
            'loan_taking_loan_detail.loan_purpose.*' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_date' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_location' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_amount' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_witness.*' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_witness' => 'required|array|max:255',
            'loan_taking_loan_detail.loan_docs_write' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_docs_address' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_medium.*' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_medium' => 'required|array|max:255',
            'loan_taking_loan_detail.is_loan_docs' => 'required|string|max:255',
            'loan_taking_loan_detail.is_loan_same' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_tamasuk_amount' => 'required|string|max:255',
            'loan_taking_loan_detail.loan_transaction_actual_amount' => 'required|string|max:255',
            'loan_taking_loan_detail.is_taken_loan_stamp' => 'required|string|max:255',
            'loan_taking_loan_detail.taken_loan_stamp_amount' => 'required|string|max:255',
            'loan_taking_loan_detail.is_written_tamsuk_changed' => 'required|string|max:255',
            'loan_taking_loan_detail.is_land_return_promise' => 'required|string|max:255',
            'loan_taking_loan_detail.is_other_return_promise' => 'required|string|max:255',
            'loan_taking_loan_detail.land_used_by_name' => 'nullable|string|max:255',
            'loan_taking_loan_detail.land_used_by_address' => 'nullable|string|max:255',
            'loan_taking_loan_detail.is_land_stop_promise' => 'required|boolean',
            'loan_taking_loan_detail.land_stop_promise_state' => 'required_if:loan_taking_loan_detail.is_land_stop_promise,1|nullable',
            'loan_taking_loan_detail.land_stop_promise_used_by_name' => 'nullable|string|max:255',
            'loan_taking_loan_detail.land_stop_promise_used_by_address' => 'nullable|string|max:255',
            'loan_taking_loan_detail.is_witness_any_promise' => 'required|boolean',
            'loan_taking_loan_detail.witness_any_promise_state' => 'required_if:loan_taking_loan_detail.is_witness_any_promise,1|nullable',
            'loan_taking_loan_detail.land_stop_promise_who_name' => 'required|string|max:255',
            'loan_taking_loan_detail.land_rights_possessed_by_whome' => 'required|string|max:255',



        ]);
        if ($request->has('loan_taking_loan_detail')) {
            $loanDetailsData = $request->input('loan_taking_loan_detail');
        
            $loanDetail = LoanTakingLoanDetail::updateOrCreate(
                ['id' => $id], 
                [
                    'loan_purpose' => implode(',', $loanDetailsData['loan_purpose']),
                    'loan_date' => $loanDetailsData['loan_date'],
                    'loan_location' => $loanDetailsData['loan_location'],
                    'loan_amount' => $loanDetailsData['loan_amount'],
                    'loan_witness' => implode(',', $loanDetailsData['loan_witness']) ?? '',
                    'loan_docs_write' => $loanDetailsData['loan_docs_write'],
                    'loan_docs_address' => $loanDetailsData['loan_docs_address'],
                    'loan_medium' => implode(',', $loanDetailsData['loan_medium']) ?? '',
                    'is_loan_docs' => $loanDetailsData['is_loan_docs'],
                    'is_loan_same' => $loanDetailsData['is_loan_same'],
                    'loan_tamasuk_amount' => $loanDetailsData['loan_tamasuk_amount'],
                    'loan_transaction_actual_amount' => $loanDetailsData['loan_transaction_actual_amount'],
                    'is_taken_loan_stamp' => $loanDetailsData['is_taken_loan_stamp'],
                    'taken_loan_stamp_amount' => $loanDetailsData['taken_loan_stamp_amount'],
                    'is_written_tamsuk_changed' => $loanDetailsData['is_written_tamsuk_changed'],
                    'is_land_return_promise' => $loanDetailsData['is_land_return_promise'],
                    'is_other_return_promise' => $loanDetailsData['is_other_return_promise'],
                    'land_used_by_name' => $loanDetailsData['land_used_by_name'] ?? null,
                    'land_used_by_address' => $loanDetailsData['land_used_by_address'] ?? null,
                    'is_land_stop_promise' => $loanDetailsData['is_land_stop_promise'],
                    'land_stop_promise_state' => $loanDetailsData['land_stop_promise_state'] ?? null,
                    'land_stop_promise_used_by_name' => $loanDetailsData['land_stop_promise_used_by_name'] ?? null,
                    'land_stop_promise_used_by_address' => $loanDetailsData['land_stop_promise_used_by_address'] ?? null,
                    'is_witness_any_promise' => $loanDetailsData['is_witness_any_promise'],
                    'witness_any_promise_state' => $loanDetailsData['witness_any_promise_state'] ?? null,
                    'land_stop_promise_who_name' => $loanDetailsData['land_stop_promise_who_name'],
                    'land_rights_possessed_by_whome' => $loanDetailsData['land_rights_possessed_by_whome'],
            
           
        ]);
    }
        
           //For interest

           $validateInterestDetailData = $request->validate([
            'loan_taking_interest_detail.written_docs_interest_rate' => 'required|string|max:255',
            'loan_taking_interest_detail.written_docs_given_interest_rate' => 'required|string|max:255',
            'loan_taking_interest_detail.till_now_interest_amount' => 'required|string|max:255',
            'loan_taking_interest_detail.interest_paid_medium' => 'required|array|max:255',
            'loan_taking_interest_detail.interest_paid_medium.*' => 'required|string|max:255',
            'loan_taking_interest_detail.till_now_paid_capital' => 'required|string|max:255',
            'loan_taking_interest_detail.till_now_to_be_paid_amount' => 'required|string|max:255',
            'loan_taking_interest_detail.is_registered_inward' => 'required|boolean|max:255',
            'loan_taking_interest_detail.registered_no' => 'required_if:loan_taking_interest_detail.is_registered_inward,1|nullable',
            'loan_taking_interest_detail.loan_amount_pay_last_date' => 'required|string|max:255',

        ]);

        if ($request->has('loan_taking_interest_detail')) {
            $interestDetailsData = $request->input('loan_taking_interest_detail');
        
            $interestDetails = LoanTakingInterestDetail::updateOrCreate(
                ['id' => $id], 
                [
                    'written_docs_interest_rate' => $interestDetailsData['written_docs_interest_rate'],
                'written_docs_given_interest_rate' => $interestDetailsData['written_docs_given_interest_rate'],
                'till_now_interest_amount' => $interestDetailsData['till_now_interest_amount'],
                'interest_paid_medium' => implode(',', $interestDetailsData['interest_paid_medium']) ?? '',
                // 'interest_paid_medium' => $interestDetailsData['interest_paid_medium'],
                'till_now_paid_capital' => $interestDetailsData['till_now_paid_capital'],
                'till_now_to_be_paid_amount' => $interestDetailsData['till_now_to_be_paid_amount'],
                'is_registered_inward' => $interestDetailsData['is_registered_inward'],
                'registered_no' => $interestDetailsData['registered_no'] ?? null,
                'loan_amount_pay_last_date' => $interestDetailsData['loan_amount_pay_last_date'],
                ]
            );
        }

        //FOR COURT

        $validateCourtDetailData = $request->validate([
        'loan_taking_court_detail.is_issue_in_court' => 'required|boolean|max:255',
        'loan_taking_court_detail.issue_in_court_result' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.issue_in_court_subject' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.issue_in_court_subject_no' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.is_issue_in_court_applicant_asset_collapse' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.applicant_collapse_by_who_name' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.applicant_collapse_by_who_address' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.is_application_decision_jailtime' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.is_jail_subjected' => 'required_if:loan_taking_court_detail.is_issue_in_court,1|nullable',
        'loan_taking_court_detail.if_in_jail_start_date' => 'required_if:loan_taking_court_detail.is_jail_subjected,1|nullable',
        'loan_taking_court_detail.if_in_jail_start_duration' => 'required_if:loan_taking_court_detail.is_jail_subjected,1|nullable',
        'loan_taking_court_detail.is_cheque_bounce_case' => 'required|boolean|max:255',
        'loan_taking_court_detail.cheque_bounce_case_result' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
        'loan_taking_court_detail.if_bank_cheque_case_resulted' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
        'loan_taking_court_detail.case_result_bigo' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
        'loan_taking_court_detail.case_result_fine' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
        'loan_taking_court_detail.case_result_jail' => 'required_if:loan_taking_court_detail.is_cheque_bounce_case,1|nullable',
    
            ]);

            if ($request->has('loan_taking_court_detail')) {
                $courtDetailsData = $request->input('loan_taking_court_detail');
            
                $courtDetails = LoanTakingCourtDetail::updateOrCreate(
                    ['id' => $id], 
                    [
                        'is_issue_in_court' => $courtDetailsData['is_issue_in_court'],
                        'issue_in_court_result' => $courtDetailsData['issue_in_court_result'] ?? null,
                        'issue_in_court_subject' => $courtDetailsData['issue_in_court_subject'] ?? null,
                        'issue_in_court_subject_no' => $courtDetailsData['issue_in_court_subject_no'] ?? null,
                        'is_issue_in_court_applicant_asset_collapse' => $courtDetailsData['is_issue_in_court_applicant_asset_collapse'] ?? null,
                        'applicant_collapse_by_who_name' => $courtDetailsData['applicant_collapse_by_who_name'] ?? null,
                        'applicant_collapse_by_who_address' => $courtDetailsData['applicant_collapse_by_who_address'] ?? null,
                        'is_application_decision_jailtime' => $courtDetailsData['is_application_decision_jailtime'] ?? null,
                        'is_jail_subjected' => $courtDetailsData['is_jail_subjected'] ?? null,
                        'if_in_jail_start_date' => $courtDetailsData['if_in_jail_start_date'] ?? null,
                        'if_in_jail_start_duration' => $courtDetailsData['if_in_jail_start_duration'] ?? null,
                        'is_cheque_bounce_case' => $courtDetailsData['is_cheque_bounce_case'],
                        'cheque_bounce_case_result' => $courtDetailsData['cheque_bounce_case_result'] ?? null,
                        'if_bank_cheque_case_resulted' => $courtDetailsData['if_bank_cheque_case_resulted'] ?? null,
                        'case_result_bigo' => $courtDetailsData['case_result_bigo'] ?? null,
                        'case_result_fine' => $courtDetailsData['case_result_fine'] ?? null,
                        'case_result_jail' => $courtDetailsData['case_result_jail'] ?? null,

                    ]
                );
            }

            //FOR ADDTIIONAL DETAIL

            $validateAdditionalDetailData = $request->validate([
                'loan_taking_additional_detail.applicant_house_no' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_area'=> 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_area.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_type' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_type.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_storeyed' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_storeyed.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_state' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_state.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_district' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_district.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_local' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_local.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_house_ward' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_house_ward.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_kitta_no' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_kitta_no.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_area' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_area.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_state' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_state.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_district' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_district.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_local' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_local.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_land_ward' => 'required|array|max:255',
            'loan_taking_additional_detail.applicant_land_ward.*' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_vehicle_details' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_current_asset_details' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_org_name' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_finance_org_branch' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_account_opening_date' => 'required|string|max:255',
            'loan_taking_additional_detail.applicant_finance_amount' => 'required|string|max:255',
            'loan_taking_additional_detail.transaction_actual_interest' => 'nullable|string|max:255',
            'loan_taking_additional_detail.other_details_in_transaction' => 'nullable|string|max:255',
            'loan_taking_additional_detail.application_verifying_document' => 'nullable|array|max:255',
            'loan_taking_additional_detail.application_verifying_document.*' => 'nullable|string|max:255',
            'loan_taking_additional_detail.application_document_file' => 'nullable|array',
            'loan_taking_additional_detail.application_document_file.*' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif2|max:3000',
            'loan_taking_additional_detail.is_crime_reported' => 'nullable|boolean|max:255',
            'loan_taking_additional_detail.if_crime_reported' => 'required_if:loan_taking_additional_detail.is_crime_reported,1|nullable',
            'loan_taking_additional_detail.stamp_person_name' => 'nullable|string|max:255',
            'loan_taking_additional_detail.stamp_person_signature' => 'nullable|string|max:255',
            'loan_taking_additional_detail.stamp_date' => 'nullable|string|max:255',

            ]);
            
            if ($request->has('loan_taking_additional_detail')) {
                $additionalDetailData = $request->input('loan_taking_additional_detail');
                $otherDetailsInTransaction = null;
                if (array_key_exists('other_details_in_transaction', $additionalDetailData)) {
                    $otherDetailsInTransaction = $additionalDetailData['other_details_in_transaction'];
                }
                $additionalDetail = LoanTakingAdditionalDetail::updateOrCreate(
                    ['id' => $id],
                    [
                        'applicant_house_no' => $additionalDetailData['applicant_house_no'],
                        'applicant_house_area' =>  implode(',', $additionalDetailData['applicant_house_area']),
                        'applicant_house_type' =>  implode(',',$additionalDetailData['applicant_house_type']),
                        'applicant_house_storeyed' =>  implode(',', $additionalDetailData['applicant_house_storeyed']),
                        'applicant_house_state' => implode(',', $additionalDetailData['applicant_house_state']) ?? '',
                        'applicant_house_district' => implode(',', $additionalDetailData['applicant_house_district']),
                        'applicant_house_local' => implode(',', $additionalDetailData['applicant_house_local']),
                        'applicant_house_ward' => implode(',', $additionalDetailData['applicant_house_ward']),
                        'applicant_land_kitta_no' => implode(',', $additionalDetailData['applicant_land_kitta_no']),
                        'applicant_land_area' => implode(',', $additionalDetailData['applicant_land_area']),
                        'applicant_land_state' => implode(',', $additionalDetailData['applicant_land_state']),
                        'applicant_land_district' => implode(',', $additionalDetailData['applicant_land_district']),
                        'applicant_land_local' => implode(',', $additionalDetailData['applicant_land_local']),
                        'applicant_land_ward' => implode(',', $additionalDetailData['applicant_land_ward']),
                        'applicant_vehicle_details' => $additionalDetailData['applicant_vehicle_details'],
                        'applicant_current_asset_details' => $additionalDetailData['applicant_current_asset_details'],
                        'applicant_org_name' => $additionalDetailData['applicant_org_name'],
                        'applicant_finance_org_branch' => $additionalDetailData['applicant_finance_org_branch'],
                        'applicant_account_opening_date' => $additionalDetailData['applicant_account_opening_date'],
                        'applicant_finance_amount' => $additionalDetailData['applicant_finance_amount'],
                        'is_crime_reported' => $additionalDetaisData['is_crime_reported'] ?? null,
                        'if_crime_reported' => $additionalDetailData['if_crime_reported'] ?? null,
                        'transaction_actual_interest' => $additionalDetailData['transaction_actual_interest'] ?? null,
                        'application_verifying_document' => implode(',', $additionalDetailData['application_verifying_document']) ?? null,
                        'application_document_file' => isset($additionalDetailData['application_document_file']) ? implode(',', $additionalDetailData['application_document_file']) : null,
                        'stamp_person_name' => $additionalDetailData['stamp_person_name'] ?? null,
                        'stamp_person_signature' => $additionalDetailData['stamp_person_signature'] ?? null,
                        'stamp_date' => $additionalDetailData['stamp_date'] ?? null,
                    ]
                );
            }
            
            // Fetch the updated data after the update operation
            $loanTakingVictim = LoanTakingVictim::findOrFail($id);
    
            // Redirect back to the update page with success message and updated data
            return view('admin.LoanTakingVictim.index', [
                'loanTakingVictim' => $loanTakingVictim,
                'success' => 'Details updated successfully.'
            ]);
        } catch (\Exception $e) {
            // Log the exception for further investigation
            Log::error('Error updating registration: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Failed to update details. Error: ' . $e->getMessage());
        }
    }
    public function destroy(LoanTakingVictim $loanTakingVictim, $id)
    {
        $loanTakingVictim = LoanTakingVictim::find($id);
        $loanTakingVictim->delete();
        return redirect()->route('admin.loantaking-victim.index')->with('status','Data Deleted Successfully');
    }
    
}



