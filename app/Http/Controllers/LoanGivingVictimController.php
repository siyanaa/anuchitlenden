<?php

namespace App\Http\Controllers;

use App\Models\LoanGivingApplicantBasicDetail;
use App\Models\LoanGivingApplicationOtherDetails;
use Log;
use App\Models\Proof;
use App\Models\State;
use App\Models\District;
use App\Models\LocalGovernment;
use App\Models\Nature;
use App\Models\TransactionNature;
use App\Models\Purpose;
use Illuminate\Http\Request;
use App\Models\LoanGivingVictim;
use App\Models\LoanGivingRegistration;
use App\Models\LoanGivingTransactionApplicationDetail;
use App\Models\LoanGivingApplicationRegistration;
use App\Models\LoanGivingApplicationFinanceCond;
use App\Models\LoanGivingDebtorApplicationDetail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoanGivingVictimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $userId = Auth::id();
          
           
            $data = LoanGivingVictim::with(['basicDetailRegistration', 'debtorDetails'])
            ->where('register_by', $userId) // Filter records by the authenticated user's ID
            ->latest()
            ->get();
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
                ->addColumn('debtor_name', function ($row) {
                    return $row->debtorDetails->debtor_name ?? '';
                })
                ->addColumn('debit_date', function ($row) {
                    return $row->debtorDetails->debit_date ?? '';
                })
                ->addColumn('debit_amount', function ($row) {
                    return $row->debtorDetails->debit_amount ?? '';
                })
                ->addColumn('debit_medium', function ($row) {
                    return $row->debtorDetails->debit_medium ?? '';
                })
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('admin.loangiving-victim.show', $row->id) . '" class="btn btn-primary btn-sm">Show</a>
                            <a href="' . route('admin.loangiving-victim.edit', $row->id) . '" class="btn btn-info btn-sm">Edit</a>
                            <form action="' . route('admin.loangiving-victim.destroy', $row->id) . '" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.LoanGivingVictim.index');
    }



    public function getForDataTable($request)
    {

        $dataTableQuery = LoanGivingVictim::where(function ($query) use ($request) {
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
        //
        $page_title = 'अनुचित लेनदेन (मिटरब्याज) सम्बन्धी ऋण दिने व्यक्तिले भर्नुपर्ने फाराम: २';
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $locals = LocalGovernment::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $locals = LocalGovernment::select('name', 'id')->get();
        $loanGivingVictim = LoanGivingVictim::all();
        $user = Auth::user();
        return view('admin.LoanGivingVictim.create', compact('page_title', 'states', 'natures', 'proofs', 'purposes','districts','locals','loanGivingVictim', 'user'));
    }


    public function store(Request $request)
    {

        $user = Auth::user();

        
        // $data['register_by'] = $user->id;
        // $register_by = LoanGivingVictim::Create($data);




        $validatedData = $request->validate([
            'loan_giving_application_registration.registration_id' => 'string|max:255',
            'loan_giving_application_registration.registration_date' => 'string|max:255',
            'loan_giving_application_registration.registration_office' => 'string|max:255',

        ]);
        if ($request->has('loan_giving_application_registration')) {
            $registrationData = $validatedData['loan_giving_application_registration'];
            $registration = LoanGivingApplicationRegistration::create([
                'registration_id' => $registrationData['registration_id'],
                'registration_date' => $registrationData['registration_date'],
                'registration_office' => $registrationData['registration_office'],
            ]);
        } else {
            return redirect()->back()->with('error', 'Registration details are missing.');
        }

        $validateRegisterData = $request->validate([
            'loan_giving_applicant_basic_detail.applicant_name' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_age' => 'nullable|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_citizenship' => 'nullable|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_citizenship_issue_district' => 'nullable|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_citizenship_issue_date' => 'nullable|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_fathername' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_fathers_no' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_spouse' => 'nullable|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_spouse_no' => 'nullable|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_family' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_annual_income' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_permanent_state' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_permanent_district' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_permanent_local' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_permanent_ward' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_temp_state' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_temp_district' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_temp_local' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_temp_ward' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_pan' => 'nullable|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_occup' => 'required|string|max:255',
            'loan_giving_applicant_basic_detail.applicant_edu' => 'nullable|string|max:255',
        ]);
        if ($request->has('loan_giving_applicant_basic_detail')) {
            $basicDetailsData = $validateRegisterData['loan_giving_applicant_basic_detail'];
            $loanDetailBasic = LoanGivingApplicantBasicDetail::create([
                'applicant_name' => $basicDetailsData['applicant_name'],
                'applicant_age' => $basicDetailsData['applicant_age']?? null,
                'applicant_citizenship' => $basicDetailsData['applicant_citizenship']?? null,
                'applicant_citizenship_issue_district' => $basicDetailsData['applicant_citizenship_issue_district']?? null,
                'applicant_citizenship_issue_date' => $basicDetailsData['applicant_citizenship_issue_date']?? null,
                'applicant_fathername' => $basicDetailsData['applicant_fathername'],
                'applicant_fathers_no' => $basicDetailsData['applicant_fathers_no'],
                'applicant_spouse' => $basicDetailsData['applicant_spouse']?? null,
                'applicant_spouse_no' => $basicDetailsData['applicant_spouse_no']?? null,
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
                'applicant_pan' => $basicDetailsData['applicant_pan']?? null,
                'applicant_occup' => $basicDetailsData['applicant_occup'],
                'applicant_edu' => $basicDetailsData['applicant_edu']?? null,
            ]);
        }

        $validatedFinanceData = $request->validate([
            'loan_giving_applicant_finance_cond.home_no' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.home_area' => 'array|max:255',
            'loan_giving_applicant_finance_cond.home_area.*' => 'string|max:255',
            'loan_giving_applicant_finance_cond.home_type' => 'array|max:255',
            'loan_giving_applicant_finance_cond.home_type.*' => 'string|max:255',
            'loan_giving_applicant_finance_cond.home_storey' => 'array|max:255',
            'loan_giving_applicant_finance_cond.home_storey.*' => 'string|max:255',
            'loan_giving_applicant_finance_cond.home_state' => 'required|required|array|max:255',
            'loan_giving_applicant_finance_cond.home_state.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.home_district' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.home_district.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.home_local' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.home_local.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.home_ward' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.home_ward.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.land_kitta' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.land_kitta.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.land_area' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.land_area.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.land_state' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.land_state.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.land_district' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.land_district.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.land_local' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.land_local.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.land_ward' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.land_ward.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.vehicle_description' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.vehicle_description.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.vehicle_count' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.vehicle_count.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.amount_asset_description' => 'required|array|max:255',
            'loan_giving_applicant_finance_cond.amount_asset_description.*' => 'required|string|max:255',
            'loan_giving_applicant_finance_cond.amount_asset_count' => 'required|array|max:255',

            'loan_giving_applicant_finance_cond.finance_name' => 'nullable|array|max:255',
            'loan_giving_applicant_finance_cond.finance_name.*' => 'nullable|string|max:255',
            'loan_giving_applicant_finance_cond.finance_branch' => 'nullable|array|max:255',
            'loan_giving_applicant_finance_cond.finance_branch.*' => 'nullable|string|max:255',
            'loan_giving_applicant_finance_cond.finance_accountissue_date' => 'nullable|array|max:255',
            'loan_giving_applicant_finance_cond.finance_accountissue_date.*' => 'nullable|string|max:255',
            'loan_giving_applicant_finance_cond.finance_data' => 'nullable|array|max:255',
            'loan_giving_applicant_finance_cond.finance_data.*' => 'nullable|string|max:255',

            'loan_giving_applicant_finance_cond.loan_finance_name' => 'nullable|array|max:255',
            'loan_giving_applicant_finance_cond.loan_finance_name.*' => 'nullable|string|max:255',
            'loan_giving_applicant_finance_cond.loan_finance_branch' => 'nullable|array|max:255',
            'loan_giving_applicant_finance_cond.loan_finance_branch.*' => 'nullable|string|max:255',
            'loan_giving_applicant_finance_cond.loan_finance_liability' => 'nullable|array|max:255',
            'loan_giving_applicant_finance_cond.loan_finance_liability.*' => 'nullable|string|max:255',
            'loan_giving_applicant_finance_cond.loan_finance_remainingpay' => 'nullable|array|max:255',
            'loan_giving_applicant_finance_cond.loan_finance_remainingpay.*' => 'nullable|string|max:255',
        ]);
        try {
            $financeDetail = LoanGivingApplicationFinanceCond::create([
                'home_no' => $validatedFinanceData['loan_giving_applicant_finance_cond']['home_no'],
                'home_area' =>   implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['home_area']),
                'home_type' =>   implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['home_type']),
                'home_storey' =>  implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['home_storey']),
                'home_state' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['home_state']),
                'home_district' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['home_district']),
                'home_local' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['home_local']),
                'home_ward' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['home_ward']),
                'land_kitta' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_kitta']),
                'land_area' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_area']),
                'land_state' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_state']),
                'land_district' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_district']),
                'land_local' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_local']),
                'land_ward' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_ward']),
                'vehicle_description' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['vehicle_description']),
                'vehicle_count' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['vehicle_count']),
                'amount_asset_description' => implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['amount_asset_description']),
                'amount_asset_count' => implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['amount_asset_count']),

               'finance_name' => !empty($validatedFinanceData['loan_giving_applicant_finance_cond']['finance_name']) ? implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['finance_name']) : null,
               'finance_branch' => !empty($validatedFinanceData['loan_giving_applicant_finance_cond']['finance_branch']) ? implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['finance_branch']) : null,
               'finance_accountissue_date' => !empty($validatedFinanceData['loan_giving_applicant_finance_cond']['finance_accountissue_date']) ? implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['finance_accountissue_date']) : null,
               'finance_data' => !empty($validatedFinanceData['loan_giving_applicant_finance_cond']['finance_data']) ? implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['finance_data']) : null,

                'loan_finance_name' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['loan_finance_name'])?? null,
                'loan_finance_branch' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['loan_finance_branch'])?? null,
                'loan_finance_liability' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['loan_finance_liability'])?? null,
                'loan_finance_remainingpay' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['loan_finance_remainingpay'])?? null,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error' . $e->getMessage());
        }

        $validatedData = $request->validate([
            'loan_giving_transaction_application_detail.trans_medium' => 'required|array',
            'loan_giving_transaction_application_detail.trans_amount' => 'required|array',
            'loan_giving_transaction_application_detail.trans_medium.*' => 'required|string|max:500',
            'loan_giving_transaction_application_detail.trans_capital_medium' => 'required|array',
            'loan_giving_transaction_application_detail.trans_capital_amount' => 'required|array',
            'loan_giving_transaction_application_detail.trans_capital_medium.*' => 'required|string|max:500',
            'loan_giving_transaction_application_detail.comp_amt_rem_prin' => 'required|string|max:500',
            'loan_giving_transaction_application_detail.comp_amt_rem_interest' => 'required|string|max:500',
        ]);
        try {
            // Create transaction details record
            $transactionDetail = LoanGivingTransactionApplicationDetail::create([
                'trans_medium' => implode(',', $validatedData['loan_giving_transaction_application_detail']['trans_medium']),
                'trans_amount' => implode(',', $validatedData['loan_giving_transaction_application_detail']['trans_amount']),
                'trans_capital_medium' => implode(',', $validatedData['loan_giving_transaction_application_detail']['trans_capital_medium']),
                'trans_capital_amount' => implode(',', $validatedData['loan_giving_transaction_application_detail']['trans_capital_amount']),
                'comp_amt_rem_prin' => $validatedData['loan_giving_transaction_application_detail']['comp_amt_rem_prin'],
                'comp_amt_rem_interest' => $validatedData['loan_giving_transaction_application_detail']['comp_amt_rem_interest'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error' . $e->getMessage());
        }


        $validatedData = $request->validate([
            'loan_giving_debtor_application_detail.debtor_name' => 'required|string|max:255',
            // 'loan_giving_debtor_application_detail.debtor_state' => 'nullable|string|max:255',
            // 'loan_giving_debtor_application_detail.debtor_district' => 'nullable|string|max:255',
            'loan_giving_debtor_application_detail.debtor_local' => 'required|string|max:255',
            // 'loan_giving_debtor_application_detail.debtor_ward' => 'nullable|string|max:255',
            'loan_giving_debtor_application_detail.debit_date' => 'required|string|max:255',
            'loan_giving_debtor_application_detail.debit_amount' => 'required|string|max:255',
            'loan_giving_debtor_application_detail.debit_medium' => 'required|array|max:255',
            'loan_giving_debtor_application_detail.other_debtors_no' => 'required|string|max:255',
            'loan_giving_debtor_application_detail.other_debtors_amount' => 'required|string|max:255',
            'loan_giving_debtor_application_detail.is_statement_register' => 'required|boolean|max:255',
            'loan_giving_debtor_application_detail.statement_register_no' => 'required_if:loan_giving_debtor_application_detail.is_statement_register,1|nullable',

        ]);

        // Initialize $DebtorDetail variable to null
        $DebtorDetail = null;

        if ($request->has('loan_giving_debtor_application_detail')) {
            $loanDebtorssData = $validatedData['loan_giving_debtor_application_detail'];
            $DebtorDetail = LoanGivingDebtorApplicationDetail::create([
                'debtor_name' => $loanDebtorssData['debtor_name'],
                // 'debtor_state' => $loanDebtorssData['debtor_state'],
                // 'debtor_district' => $loanDebtorssData['debtor_district'],
                'debtor_local' => $loanDebtorssData['debtor_local'],
                // 'debtor_ward' => $loanDebtorssData['debtor_ward'],
                'debit_date' => $loanDebtorssData['debit_date'],
                'debit_amount' => $loanDebtorssData['debit_amount'],
                'debit_medium' => implode(',',$loanDebtorssData['debit_medium']),
                'other_debtors_no' => $loanDebtorssData['other_debtors_no'],
                'other_debtors_amount' => $loanDebtorssData['other_debtors_amount'],
                'is_statement_register' => $loanDebtorssData['is_statement_register'],
                'statement_register_no' => $loanDebtorssData['statement_register_no']?? null,
            ]);
        }


        $validatedData = $request->validate([
            'loan_giving_application_other_details.loan_landrestrict_owner' => 'required|string|max:255',
            'loan_giving_application_other_details.loan_taking_person_name' => 'required|string|max:255',
            'loan_giving_application_other_details.land_passed_name' => 'required|string|max:255',
            'loan_giving_application_other_details.registered_person_relation' => 'required|string|max:255',
            'loan_giving_application_other_details.landrestrict_kitta' => 'required|array|max:255',
            'loan_giving_application_other_details.landrestrict_area' => 'required|array|max:255',
            'loan_giving_application_other_details.landrestrict_state' => 'required|array|max:255',
            'loan_giving_application_other_details.landrestrict_district' => 'required|array|max:255',
            'loan_giving_application_other_details.landrestrict_local' => 'required|array|max:255',
            'loan_giving_application_other_details.landrestrict_ward' => 'required|array|max:255',
            'loan_giving_application_other_details.landrestrict_registration_date' => 'required|string|max:255',


            'loan_giving_application_other_details.is_loan_cheque_shown' => 'required|boolean',
            'loan_giving_application_other_details.cheque_giving_person' => 'required_if:loan_giving_application_other_details.is_loan_cheque_shown,1|nullable',
            'loan_giving_application_other_details.cheque_receiving_person' => 'required_if:loan_giving_application_other_details.is_loan_cheque_shown,1|nullable',
            'loan_giving_application_other_details.cheque_issue_date' => 'required_if:loan_giving_application_other_details.is_loan_cheque_shown,1|nullable',
            'loan_giving_application_other_details.cheque_bounce_date' => 'required_if:loan_giving_application_other_details.is_loan_cheque_shown,1|nullable',
            'loan_giving_application_other_details.cheque_detail_amount' => 'required_if:loan_giving_application_other_details.is_loan_cheque_shown,1|nullable',
            'loan_giving_application_other_details.cheque_other_details' => 'required_if:loan_giving_application_other_details.is_loan_cheque_shown,1|nullable',
            'loan_giving_application_other_details.is_court_case_pending' => 'required|boolean|max:255',
            'loan_giving_application_other_details.court_case_state_name' => 'required_if:loan_giving_application_other_details.is_court_case_pending,1|nullable',
            'loan_giving_application_other_details.court_case_subject' => 'required_if:loan_giving_application_other_details.is_court_case_pending,1|nullable',
            // 'loan_giving_application_other_details.court_case_no' => 'nullable|string|max:255',
            'loan_giving_application_other_details.is_amount_short_person_injail' => 'required_if:loan_giving_application_other_details.is_court_case_pending,1|nullable',
            'loan_giving_application_other_details.is_court_case_done' => 'required_if:loan_giving_application_other_details.is_court_case_pending,1|nullable',
            'loan_giving_application_other_details.landrestricted_usedby_now' => 'nullable|string|max:255',
            'loan_giving_application_other_details.is_when_registered_otherdocs' => 'required|boolean|max:255',
            'loan_giving_application_other_details.when_registered_othercondition_name' => 'nullable|array',
            'loan_giving_application_other_details.when_registered_othercondition_name.*' => 'nullable|string|max:255',
            'loan_giving_application_other_details.other_details_in_transaction' => 'nullable|string|max:255',

            'loan_giving_application_other_details.application_attached_documents' => 'nullable|array|max:255',
            'loan_giving_application_other_details.application_attached_documents.*' => 'nullable|string|max:255',
        
            'loan_giving_application_other_details.application_document_file' => 'nullable|array|max:10240',
            'loan_giving_application_other_details.application_document_file.*' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif2|max:10240',

            'loan_giving_application_other_details.stamped_name' => 'nullable|string|max:255',
            'loan_giving_application_other_details.stamped_date' => 'nullable|string|max:255',

        ]);

    //     $filePaths = [];
    // if ($request->hasFile('loan_giving_application_other_details.application_document_file')) {
    //     foreach ($request->file('loan_giving_application_other_details.application_document_file') as $file) {
    //         // Store the file and get the path
    //         $path = $file->store('/storage');
    //         $filePaths[] = $path;
    //     }
    // }

        $OtherDetail = null;
        
            if ($request->has('loan_giving_application_other_details')) {
                $loanOthersData = $validatedData['loan_giving_application_other_details'];
        
                $OtherDetail = LoanGivingApplicationOtherDetails::create([
                    'loan_landrestrict_owner' => $loanOthersData['loan_landrestrict_owner'],
                    'loan_taking_person_name' => $loanOthersData['loan_taking_person_name'],
                    'land_passed_name' => $loanOthersData['land_passed_name'],
                    'registered_person_relation' => $loanOthersData['registered_person_relation'],
                    'landrestrict_kitta' => implode(',', $loanOthersData['landrestrict_kitta']),
                    'landrestrict_area' => implode(',', $loanOthersData['landrestrict_area']),
                    'landrestrict_state' => implode(',', $loanOthersData['landrestrict_state']),
                    'landrestrict_district' => implode(',', $loanOthersData['landrestrict_district']),
                    'landrestrict_local' => implode(',', $loanOthersData['landrestrict_local']),
                    'landrestrict_ward' => implode(',', $loanOthersData['landrestrict_ward']),
                    'landrestrict_registration_date' => $loanOthersData['landrestrict_registration_date'],
                    'is_loan_cheque_shown' => $loanOthersData['is_loan_cheque_shown'],
                    'cheque_giving_person' => $loanOthersData['cheque_giving_person'] ?? null,
                    'cheque_receiving_person' => $loanOthersData['cheque_receiving_person'] ?? null,
                    'cheque_issue_date' => $loanOthersData['cheque_issue_date'] ?? null,
                    'cheque_bounce_date' => $loanOthersData['cheque_bounce_date'] ?? null,
                    'cheque_detail_amount' => $loanOthersData['cheque_detail_amount'] ?? null,
                    'cheque_other_details' => $loanOthersData['cheque_other_details'] ?? null,
                    'is_court_case_pending' => $loanOthersData['is_court_case_pending'],
                    'court_case_state_name' => $loanOthersData['court_case_state_name'] ?? null,
                    'court_case_subject' => $loanOthersData['court_case_subject'] ?? null,
                    'is_amount_short_person_injail' => $loanOthersData['is_amount_short_person_injail'] ?? null,
                    'is_court_case_done' => $loanOthersData['is_court_case_done'] ?? null,
                    'landrestricted_usedby_now' => $loanOthersData['landrestricted_usedby_now'] ?? null,
                    'is_when_registered_otherdocs' => filter_var($loanOthersData['is_when_registered_otherdocs'], FILTER_VALIDATE_BOOLEAN),
                    'when_registered_othercondition_name' => $loanOthersData['when_registered_othercondition_name'] ? implode(',', $loanOthersData['when_registered_othercondition_name']) : null,
                    'other_details_in_transaction' => $loanOthersData['other_details_in_transaction'] ?? null,
                    'application_attached_documents' => $loanOthersData['application_attached_documents'] ? implode(',', $loanOthersData['application_attached_documents']) : null,
                    'application_document_file' => isset($loanOthersData['application_document_file']) ? implode(',', $loanOthersData['application_document_file']) : null,
                    'stamped_name' => $loanOthersData['stamped_name'] ?? null,
                    'stamped_date' => $loanOthersData['stamped_date'] ?? null,
                ]);
            }
        

        if ($DebtorDetail) {
            $loanGivingVictim = LoanGivingVictim::create([
                'register_by' => $user->id,
                'registration_id' => $registration->id,
                'basic_detail_id' => $loanDetailBasic->id,
                'applicant_finance_cond_id' => $financeDetail->id,
                'transaction_application_detail_id' => $transactionDetail->id,
                'debtor_application_detail_id' => $DebtorDetail->id,
                'other_detail_id' => $OtherDetail->id,
            ]);
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            // Handle case when debtor detail creation failed
            return redirect()->back()->with('error', 'Debtor detail creation failed.');
        }
    
}

    

    public function show($id)
    {
        $loanGivingVictim = LoanGivingVictim::findOrFail($id);
    
        // Debugging statements
        // dd($loanGivingVictim->applicationFinance->home_state, $loanGivingVictim->applicationFinance->home_district);

        $loanGivingVictim->applicationFinance->home_state = $loanGivingVictim->applicationFinance->home_state;
        $loanGivingVictim->applicationFinance->home_district = $loanGivingVictim->applicationFinance->home_district;
        $loanGivingVictim->applicationFinance->home_local= $loanGivingVictim->applicationFinance->home_local;
        
        // dd($stateId, $districtId, $localId);
         
        $stateIds = explode(',', $loanGivingVictim->applicationFinance->home_state);
        $districtIds = explode(',', $loanGivingVictim->applicationFinance->home_district);
        $states = State::select('id', 'name')->get();
        $proofs = Proof::select('title', 'id')->get();
        $loanGivingApplicationOtherDetail = LoanGivingApplicationOtherDetails::findOrFail($id);
        $previouslyStoredValue = $loanGivingApplicationOtherDetail->is_when_registered_otherdocs;
        $previouslyStoredValueForChequeShown = $loanGivingApplicationOtherDetail->is_loan_cheque_shown;
        $previouslyStoredValueForCourtDecision = $loanGivingApplicationOtherDetail->is_court_case_done;
        $previouslyStoredValueForCourtCasePending = $loanGivingApplicationOtherDetail->is_court_case_pending;
        $previouslyStoredValueForPersonJail = $loanGivingApplicationOtherDetail->is_amount_short_person_injail;
        $loanDetail = LoanGivingTransactionApplicationDetail::find($id);
        $data = LoanGivingTransactionApplicationDetail::pluck('trans_medium')->toArray();
        $dataCapital = LoanGivingTransactionApplicationDetail::pluck('trans_capital_medium')->toArray();
        $debitMedium = json_decode($loanDetail->debit_medium, true);
        
    
        // Fetching names for required IDs
        $getStateName = $this->getNameFunction($loanGivingVictim->applicationFinance->home_state, State::class);
        $getDistrictName = $this->getNameFunction($loanGivingVictim->applicationFinance->home_sdistrict, District::class);
        $getLocalName = $this->getNameFunction($loanGivingVictim->applicationFinance->home_sdistrict, LocalGovernment::class);
        $getProofName = $this->getNameFunction($loanGivingVictim->proof_id, Proof::class);
        $getPurposeName = $this->getNameFunction($loanGivingVictim->purpose_id, Purpose::class);
    
        
    
        return view('admin.LoanGivingVictim.show', compact(
            'loanGivingVictim', 'states', 'previouslyStoredValueForChequeShown',
            'previouslyStoredValueForCourtCasePending', 'previouslyStoredValueForPersonJail',
            'loanDetail', 'data', 'dataCapital', 'previouslyStoredValueForCourtDecision',
            'proofs', 'previouslyStoredValue', 'debitMedium', 'getStateName', 'getDistrictName',
            'getLocalName', 'getProofName', 'getPurposeName'
        ));
    }

/**
 * Get name(s) based on ID(s) and model class.
 *
 * @param mixed $id
 * @param string $class
 * @return Closure
 */
private function getNameFunction($id, $class)
{
    return function ($id) use ($class) {
        if (is_array($id)) {
            $items = $class::whereIn('id', $id)->pluck('name')->toArray();
            return implode(', ', $items);
        } else {
            // Handle the case when $id is a string
            if (!empty($id)) {
                $item = $class::find($id);
                return $item ? $item->name : '';
            } else {
                return '';
            }
        }
    };
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanGivingVictim $loanGivingVictim, $id)
    {
        $page_title = "ऋण दिने";
        $loanGivingVictim = LoanGivingVictim::findOrFail($id);
        //$loanGivingVictim->applicationFinance = json_decode($loanGivingVictim->applicationFinance, true);
        $states = State::select('id', 'name')->get();
        $districts = District::select('id', 'name')->get();
        $locals = LocalGovernment::select('id', 'name')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        $loanGivingApplicationFinanceCond= LoanGivingApplicationFinanceCond::findOrFail($id);
        $loanGivingApplicationOtherDetail = LoanGivingApplicationOtherDetails::findOrFail($id);
        $previouslyStoredValue = $loanGivingApplicationOtherDetail->is_when_registered_otherdocs;
        $previouslyStoredValueForCourtDecision = $loanGivingApplicationOtherDetail->is_court_case_done;
        $previouslyStoredValueForPersonJail = $loanGivingApplicationOtherDetail->is_amount_short_person_injail;
        $previouslyStoredValueForCourtCasePending = $loanGivingApplicationOtherDetail->is_court_case_pending;
        $previouslyStoredValueForChequeShown = $loanGivingApplicationOtherDetail->is_loan_cheque_shown;

        $loanGivingDebtorApplicationDetail = LoanGivingDebtorApplicationDetail::findOrFail($id);
        $previouslyStoredValueForStatementRegister = $loanGivingDebtorApplicationDetail->is_statement_register;
        $wardOptions = range(1, 35);
        $conditions = [
            'फैसला भैसकेको',
            'फैसला भई फैसला कार्यान्वयन भई सकेको',
            'फैसला भई फैसला कार्यान्वयनको क्रममा रहेको',
            'फैसला भई फैसला कार्यान्वयन हुन बाँकी रहेको',
            'आशिंक रुपमा फैसला कार्यान्वयन भएको',

        ];
        $educationLevels = [
            'सामान्य लेखपढ',
            'कक्षा ८ सम्म',
            'कक्षा १० सम्म',
            'कक्षा १२ सम्म',
            'उच्च शिक्षा',

        ];
        $homeTypes = [
            'कच्ची',
            'पक्की',
            'अन्य',
        ];
        $transactionMediums = [
            'नगद',
            'चेक',
            'जिनसी',
            'अन्य',
        ];
        $loanDetail = LoanGivingTransactionApplicationDetail::find($id);
        $data = LoanGivingTransactionApplicationDetail::pluck('trans_medium')->toArray();
        $dataCapital = LoanGivingTransactionApplicationDetail::pluck('trans_capital_medium')->toArray();



        return view('admin.LoanGivingVictim.update', compact('page_title', 'states', 'districts', 'locals', 'natures', 'proofs', 'purposes', 'loanGivingVictim', 'wardOptions', 'educationLevels', 'homeTypes', 'transactionMediums', 'loanDetail', 'data', 'dataCapital', 'previouslyStoredValue', 'previouslyStoredValueForCourtDecision', 'previouslyStoredValueForPersonJail', 'previouslyStoredValueForCourtCasePending', 'previouslyStoredValueForChequeShown', 'previouslyStoredValueForStatementRegister', 'conditions','loanGivingApplicationFinanceCond'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //FOR REGISTRATION
        try {
            // Validate the incoming request data for registration details
            $validatedRegistrationData = $request->validate([
                'loan_giving_application_registration.registration_id' => 'required|string|max:255',
                'loan_giving_application_registration.registration_date' => 'required|string|max:255',
                'loan_giving_application_registration.registration_office' => 'required|string|max:255',
            ]);
            // Find the existing registration record using the provided ID
            $registration = LoanGivingApplicationRegistration::findOrFail($id);
            // Update registration details
            $registration->update([
                'registration_id' => $validatedRegistrationData['loan_giving_application_registration']['registration_id'],
                'registration_date' => $validatedRegistrationData['loan_giving_application_registration']['registration_date'],
                'registration_office' => $validatedRegistrationData['loan_giving_application_registration']['registration_office'],
            ]);

            //FOR BASIC DETAILS

            $validatedBasicDetailData = $request->validate([
                'loan_giving_applicant_basic_detail.applicant_name' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_age' => 'nullable|string|max:255',
                'loan_giving_applicant_basic_detail.applicant_citizenship' => 'nullable|string|max:255',
                'loan_giving_applicant_basic_detail.applicant_citizenship_issue_district' => 'nullable|string|max:255',
                'loan_giving_applicant_basic_detail.applicant_citizenship_issue_date' => 'nullable|string|max:255',
                'loan_giving_applicant_basic_detail.applicant_fathername' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_fathers_no' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_spouse' => 'nullable|string|max:255',
                'loan_giving_applicant_basic_detail.applicant_spouse_no' => 'nullable|string|max:255',
                'loan_giving_applicant_basic_detail.applicant_family' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_annual_income' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_permanent_state' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_permanent_district' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_permanent_local' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_permanent_ward' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_temp_state' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_temp_district' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_temp_local' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_temp_ward' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_pan' => 'nullable|string|max:255',
                'loan_giving_applicant_basic_detail.applicant_occup' => 'string|max:255',
                'loan_giving_applicant_basic_detail.applicant_edu' => 'nullable|string|max:255',
            ]);


            // Find the existing basic detail record using the provided ID
            $basicDetail = LoanGivingApplicantBasicDetail::findOrFail($id);

            // Update basic detail data
            $basicDetail->update($validatedBasicDetailData['loan_giving_applicant_basic_detail']);

            $validatedFinanceData = $request->validate([
                'loan_giving_applicant_finance_cond.home_no' => 'string|max:255',
                'loan_giving_applicant_finance_cond.home_area' => 'array|max:255',
                'loan_giving_applicant_finance_cond.home_area.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.home_type' => 'array|max:255',
                'loan_giving_applicant_finance_cond.home_type.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.home_storey' => 'array|max:255',
                'loan_giving_applicant_finance_cond.home_storey.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.home_state' => 'array|max:255',
                'loan_giving_applicant_finance_cond.home_state.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.home_district' => 'array|max:255',
                'loan_giving_applicant_finance_cond.home_district.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.home_local' => 'array|max:255',
                'loan_giving_applicant_finance_cond.home_local.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.home_ward' => 'array|max:255',
                'loan_giving_applicant_finance_cond.home_ward.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.land_kitta' => 'array|max:255',
                'loan_giving_applicant_finance_cond.land_kitta.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.land_area' => 'array|max:255',
                'loan_giving_applicant_finance_cond.land_area.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.land_state' => 'array|max:255',
                'loan_giving_applicant_finance_cond.land_state.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.land_district' => 'array|max:255',
                'loan_giving_applicant_finance_cond.land_district.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.land_local' => 'array|max:255',
                'loan_giving_applicant_finance_cond.land_local.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.land_ward' => 'array|max:255',
                'loan_giving_applicant_finance_cond.land_ward.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.vehicle_description' => 'array|max:255',
                'loan_giving_applicant_finance_cond.vehicle_description.*' => 'string|max:255',
                'loan_giving_applicant_finance_cond.amount_asset_description' => 'array|max:255',
                'loan_giving_applicant_finance_cond.amount_asset_description.*' => 'string|max:255',

                'loan_giving_applicant_finance_cond.finance_name' => 'nullable|array|max:255',
                'loan_giving_applicant_finance_cond.finance_name.*' => 'nullable|string|max:255',
                'loan_giving_applicant_finance_cond.finance_branch' => 'nullable|array|max:255',
                'loan_giving_applicant_finance_cond.finance_branch.*' => 'nullable|string|max:255',
                'loan_giving_applicant_finance_cond.finance_accountissue_date' => 'nullable|array|max:255',
                'loan_giving_applicant_finance_cond.finance_accountissue_date.*' => 'nullable|string|max:255',
                'loan_giving_applicant_finance_cond.finance_data' => 'nullable|array|max:255',
                'loan_giving_applicant_finance_cond.finance_data.*' => 'nullable|string|max:255',

                'loan_giving_applicant_finance_cond.loan_finance_name' => 'nullable|array|max:255',
                'loan_giving_applicant_finance_cond.loan_finance_name.*' => 'nullable|string|max:255',
                'loan_giving_applicant_finance_cond.loan_finance_branch' => 'nullable|array|max:255',
                'loan_giving_applicant_finance_cond.loan_finance_branch.*' => 'nullable|string|max:255',
                'loan_giving_applicant_finance_cond.loan_finance_liability' => 'nullable|array|max:255',
                'loan_giving_applicant_finance_cond.loan_finance_liability.*' => 'nullable|string|max:255',
                'loan_giving_applicant_finance_cond.loan_finance_remainingpay' => 'nullable|array|max:255',
                'loan_giving_applicant_finance_cond.loan_finance_remainingpay.*' => 'nullable|string|max:255',
            ]);

            $financeDetail = LoanGivingApplicationFinanceCond::findOrFail($id);
            $financeDetail->update([
                'home_no' => $validatedFinanceData['loan_giving_applicant_finance_cond']['home_no'],
                'home_area' =>  implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['home_area']),
                'home_type' =>  implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['home_type']),
                'home_storey' => implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['home_storey']),
                'home_state' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['home_state']),
                'home_district' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['home_district']),
                'home_local' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['home_local']),
                'home_ward' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['home_ward']),
                'land_kitta' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_kitta']),
                'land_area' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_area']),
                'land_state' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_state']),
                'land_district' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_district']),
                'land_local' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_local']),
                'land_ward' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['land_ward']),
                'vehicle_description' => implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['vehicle_description']),
                'amount_asset_description' => implode(',',$validatedFinanceData['loan_giving_applicant_finance_cond']['amount_asset_description']),
                'finance_name' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['finance_name'])?? null,
                'finance_branch' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['finance_branch'])?? null,
                'finance_accountissue_date' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['finance_accountissue_date'])?? null,
                'finance_data' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['finance_data'])?? null,
                'loan_finance_name' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['loan_finance_name'])?? null,
                'loan_finance_branch' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['loan_finance_branch'])?? null,
                'loan_finance_liability' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['loan_finance_liability'])?? null,
                'loan_finance_remainingpay' => implode(',', $validatedFinanceData['loan_giving_applicant_finance_cond']['loan_finance_remainingpay'])?? null,
            ]);

            $transactionDetail = LoanGivingTransactionApplicationDetail::findOrFail($id);

            // Validate the incoming request data
            $validatedData = $request->validate([
                'loan_giving_transaction_application_detail.trans_medium' => 'array',
                'loan_giving_transaction_application_detail.trans_amount' => 'array',
                'loan_giving_transaction_application_detail.trans_medium.*' => 'string|max:500',
                'loan_giving_transaction_application_detail.trans_capital_medium' => 'array',
                'loan_giving_transaction_application_detail.trans_capital_amount' => 'array',
                'loan_giving_transaction_application_detail.trans_capital_medium.*' => 'string|max:500',
                'loan_giving_transaction_application_detail.comp_amt_rem_prin' => 'string|max:500',
                'loan_giving_transaction_application_detail.comp_amt_rem_interest' => 'string|max:500',
            ]);

            // Update all fields at once
            $transactionDetail->update([
                'trans_medium' => implode(',', $validatedData['loan_giving_transaction_application_detail']['trans_medium']),
                'trans_amount' => implode(',', $validatedData['loan_giving_transaction_application_detail']['trans_amount']),
                'trans_capital_medium' => implode(',', $validatedData['loan_giving_transaction_application_detail']['trans_capital_medium']),
                'trans_capital_amount' => implode(',', $validatedData['loan_giving_transaction_application_detail']['trans_capital_amount']),
                'comp_amt_rem_prin' => $validatedData['loan_giving_transaction_application_detail']['comp_amt_rem_prin'],
                'comp_amt_rem_interest' => $validatedData['loan_giving_transaction_application_detail']['comp_amt_rem_interest'],
            ]);


            // Find the DebtorDetail instance by its ID
            $DebtorDetail = LoanGivingDebtorApplicationDetail::findOrFail($id);

            // Validation rules for the request data
            $validatedData = $request->validate([
                'loan_giving_debtor_application_detail.debtor_name' => 'string|max:255',
                'loan_giving_debtor_application_detail.debtor_local' => 'string|max:255',
                'loan_giving_debtor_application_detail.debit_date' => 'string|max:255',
                'loan_giving_debtor_application_detail.debit_amount' => 'string|max:255',
                'loan_giving_debtor_application_detail.debit_medium' => 'array|max:255',
                'loan_giving_debtor_application_detail.other_debtors_no' => 'nullable|string|max:255',
                'loan_giving_debtor_application_detail.other_debtors_amount' => 'nullable|string|max:255',
                'loan_giving_debtor_application_detail.is_statement_register' => 'nullable|boolean|max:255',
                'loan_giving_debtor_application_detail.statement_register_no' => 'nullable|string|max:255',
            ]);

            $OtherDetail = LoanGivingApplicationOtherDetails::findOrFail($id);

            // Get validated data
            $validatedData = $request->validate([
                'loan_giving_application_other_details.loan_landrestrict_owner' => 'string|max:255',
                'loan_giving_application_other_details.loan_taking_person_name' => 'string|max:255',
                'loan_giving_application_other_details.land_passed_name' => 'string|max:255',

                'loan_giving_application_other_details.is_loan_cheque_shown' => 'boolean',
                'loan_giving_application_other_details.cheque_giving_person' => 'nullable|string|max:255',
                'loan_giving_application_other_details.cheque_receiving_person' => 'nullable|string|max:255',
                'loan_giving_application_other_details.cheque_issue_date' => 'nullable|string|max:255',
                'loan_giving_application_other_details.cheque_bounce_date' => 'nullable|string|max:255',
                'loan_giving_application_other_details.cheque_detail_amount' => 'nullable|string|max:255',
                'loan_giving_application_other_details.is_court_case_pending' => 'boolean',
                'loan_giving_application_other_details.court_case_state_name' => 'nullable|string|max:255',
                'loan_giving_application_other_details.court_case_subject' => 'nullable|string|max:255',
                
                'loan_giving_application_other_details.is_amount_short_person_injail' => 'nullable|boolean',
                'loan_giving_application_other_details.is_court_case_done' => 'nullable|boolean',
                'loan_giving_application_other_details.landrestricted_usedby_now' => 'nullable|string|max:255',
                'loan_giving_application_other_details.is_when_registered_otherdocs' => 'nullable|boolean',
                'loan_giving_application_other_details.when_registered_othercondition_name' => 'nullable|array',
                'loan_giving_application_other_details.other_details_in_transaction' => 'nullable|string|max:255',

                'loan_giving_application_other_details.application_attached_documents' => 'nullable|array|max:255',
                'loan_giving_application_other_details.application_attached_documents.*' => 'nullable|string|max:255',
            
                'loan_giving_application_other_details.application_document_file' => 'nullable|array|max:10240',
                'loan_giving_application_other_details.application_document_file.*' => 'nullable|file|mimes:pdf,jpeg,png,jpg,gif2|max:10240',

                'loan_giving_application_other_details.stamped_name' => 'nullable|string|max:255',
                'loan_giving_application_other_details.stamped_date' => 'nullable|string|max:255',
            ]);

            // Update all fields at once
            $OtherDetail->update($validatedData['loan_giving_application_other_details']);


            $loanGivingVictim = LoanGivingVictim::findOrFail($id);
            return view('admin.LoanGivingVictim.index', [
                
                'loanGivingVictim' => $loanGivingVictim,
                'success' => 'Details updated successfully.'
            ]);
        } catch (\Exception $e) {
            // Log the exception for further investigation
            // Log::error('Error updating registration: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update details. Error: ' . $e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanGivingVictim $loanGivingVictim, $id)
    {
        $loanGivingVictim = LoanGivingVictim::find($id);
        $loanGivingVictim->delete();
        return redirect()->route('admin.loangiving-victim.index')->with('status','Data Deleted Successfully');
    }

    
}
