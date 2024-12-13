<?php

namespace App\Http\Controllers;

use App\Exports\AgreementNoImplementationExport;
use App\Exports\CollectiveDetailsExport;
use App\Exports\IntrigatedNoTransactionDetailsExport;
use App\Exports\IntrigatedTransactionNeededDetailsExport;
use App\Exports\NoAgreementOnDiscussionDetailsExport;
use App\Exports\ReleaseExport;
use App\Models\Proof;
use App\Models\State;
use App\Models\Nature;
use App\Models\Purpose;
use App\Models\Release;


use App\Models\District;
use App\Models\Registration;

// use App\Exports\RegistrationExport;
use Illuminate\Http\Request;
use App\Exports\RegistrationExport;
use App\Exports\UnderDiscussionDetailsExport;
use App\Models\NoTransactionPurpose;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{

    public function clearSearch()
    {
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     * for R-1 दर्ता उजुरी विवरण जिल्लागत
     * @return \Illuminate\Http\Response
     */
    public function registrationDetails(Request $request)
    {

        $searchParams = $request->all();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        $noTransactionPurposes = NoTransactionPurpose::all();
        //dd($request->all());
        // $registration_reports = Registration::search($request->all())->paginate(30);
        //dd($registration_reports);
        $page_title = 'दर्ता उजुरी विवरण';

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.registration_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'searchParams', 'noTransactionPurposes'))->withInput(
            $request->except('_token'));
    }

    public function registrationDetailsShow(Request $request )
    {
        $searchParams = $request->all();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        $noTransactionPurposes = NoTransactionPurpose::all();
        //dd($request->all());
        // $registration_reports = Registration::search($request->all())->paginate(30);
        //dd($registration_reports);
        $page_title = 'दर्ता उजुरी विवरण';

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.registration_detailsshow', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'searchParams', 'noTransactionPurposes'))->withInput(
            $request->except('_token'));
    }

    public function exportRegistrationDetails(Request $request)
    {
        $searchParams = $request->query();

        // Use these search parameters to filter the data.
        $registration_reports = Registration::search($searchParams)->get();
        // dd($registration_reports);

        $export = new RegistrationExport($registration_reports);
        $fileName = 'registration_details.xlsx';
    
        return Excel::download($export, $fileName);
    }


    public function releaseDetails(Request $request)
    {
        // Retrieve all registrations along with their related data
        $searchParams = $request->all();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        $noTransactionPurposes = NoTransactionPurpose::all();
        //dd($registration_reports);
        $page_title = 'फर्छ्याेट उजुरि विवरण';

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.release_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'searchParams', 'noTransactionPurposes'))->withInput($request->input());
    }

    public function releaseDetailsShow(Request $request)
    {
        // Retrieve all registrations along with their related data
        $searchParams = $request->all();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        $noTransactionPurposes = NoTransactionPurpose::all();
        //dd($registration_reports);
        $page_title = 'फर्छ्याेट उजुरि विवरण';

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.release_detailsshow', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'searchParams', 'noTransactionPurposes'))->withInput($request->input());
    }

    public function exportReleaseDetails(Request $request)
    {
        $searchParams = $request->query();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        $export = new ReleaseExport($registration_reports);
        $fileName = 'release_details.xlsx';

        return Excel::download($export, $fileName);
    }


    public function agreementNoImplementationDetails(Request $request)
    {
        // Retrieve all registrations along with their related data
        $searchParams = $request->query();
        $registration_reports = Registration::search($searchParams)->orWhereHas('releases', function ($query) {
            $query->where('agreement_applied_status', 0);
        })->paginate(30);
        // dd($registration_reports);
        $noTransactionPurposes = NoTransactionPurpose::all();
        //dd($registration_reports);
        $page_title = "सहमतीभै कार्यान्वयन हुन बाँकीको विवरण";
        // dd("zxczxc");

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.agreement_no_implementation_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'searchParams', 'noTransactionPurposes'))->withInput($request->input());
    }

    public function agreementNoImplementationDetailsShow(Request $request)
    {
        // Retrieve all registrations along with their related data
        $searchParams = $request->query();
        $registration_reports = Registration::search($searchParams)->orWhereHas('releases', function ($query) {
            $query->where('agreement_applied_status', 0);
        })->paginate(30);
        // dd($registration_reports);
        $noTransactionPurposes = NoTransactionPurpose::all();
        //dd($registration_reports);
        $page_title = "सहमतीभै कार्यान्वयन हुन बाँकीको विवरण";
        // dd("zxczxc");

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.agreement_no_implementation_detailsshow', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'searchParams', 'noTransactionPurposes'))->withInput($request->input());
    }

    public function exportAgreementNoImplementationDetails(Request $request)
    {
        $searchParams = $request->query();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        // dd($registration_reports);
        $export = new AgreementNoImplementationExport($registration_reports);
        $fileName = 'agreement_no_implementation_details.xlsx';

        return Excel::download($export, $fileName);
    }

    public function noAgreementOnDiscussionDetails(Request $request)
    {
        $searchParams = $request->query();
        // Retrieve all registrations along with their related data
        // $registration_reports = Registration::search($request->all())->paginate(30);
        $registration_reports = Registration::where('is_active', 1)->search($searchParams)
        ->paginate(30);
        $noTransactionPurposes = NoTransactionPurpose::all();
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        $page_title = "छलफल गर्दा फर्छ्यौट/सहमती हुन नसकेको उजुरी विवरण";

        session()->flashInput($request->input());
        return view('admin.reports.no_agreement_on_discussion_details', compact('registration_reports', 'page_title', 'proofs', 'natures', 'purposes', 'states', 'searchParams', 'noTransactionPurposes'));
    }

    public function noAgreementOnDiscussionDetailsShow(Request $request)
    {
        $searchParams = $request->query();
        // Retrieve all registrations along with their related data
        // $registration_reports = Registration::search($request->all())->paginate(30);
        $registration_reports = Registration::where('is_active', 1)->search($searchParams)
        ->paginate(30);
        $noTransactionPurposes = NoTransactionPurpose::all();
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        $page_title = "छलफल गर्दा फर्छ्यौट/सहमती हुन नसकेको उजुरी विवरण";

        session()->flashInput($request->input());
        return view('admin.reports.no_agreement_on_discussion_detailsshow', compact('registration_reports', 'page_title', 'proofs', 'natures', 'purposes', 'states', 'searchParams', 'noTransactionPurposes'));
    }

    public function exportNoAgreementOnDiscussionDetails(Request $request)
    {
        $searchParams = $request->query();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        // dd($registration_reports);
        $export = new NoAgreementOnDiscussionDetailsExport($registration_reports);
        $fileName = 'no_agreement_on_discussion_details.xlsx';

        return Excel::download($export, $fileName);
    }


    
    public function underDiscussionDetails(Request $request)
    {
        // Retrieve all registrations along with their related data
        $searchParams = $request->query();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        $page_title = "छलफलको क्रममा रहेका उजुरी";
        $noTransactionPurposes = NoTransactionPurpose::all();
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.under_discussion_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'searchParams', 'noTransactionPurposes'))->withInput($request->input());
    }

    public function underDiscussionDetailsShow(Request $request)
    {
        // Retrieve all registrations along with their related data
        $searchParams = $request->query();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        $page_title = "छलफलको क्रममा रहेका उजुरी";
        $noTransactionPurposes = NoTransactionPurpose::all();
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.under_discussion_detailsshow', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'searchParams', 'noTransactionPurposes'))->withInput($request->input());
    }


    public function exportUnderDiscussionDetails(Request $request)
    {
        $searchParams = $request->query();
        $registration_reports = Registration::search($searchParams)->paginate(30);
        // dd($registration_reports);
        $export = new UnderDiscussionDetailsExport($registration_reports);
        $fileName = 'under_discussion_details.xlsx';

        return Excel::download($export, $fileName);
    }



    public function collectives(Request $request)
    {
        $registration_reports = State::search($request->all())->paginate(30);

        // dd($registration_reports[0]);

        $page_title = "एकीकृत विवरण";
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();

        session()->flashInput($request->input());

        $grandTotalRegistrationCount = District::getGrandTotalRegistrationCountForStates();
        $grandTotalUnderDiscussionCount = District::getGrandTotalUnderDiscussionCountForStates();

        return view('admin.reports.intrigated_collective', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'grandTotalRegistrationCount', 'grandTotalUnderDiscussionCount'))->withInput($request->input());
    }

    public function exportCollectiveDetails(Request $request)
    {
        // $searchParams = $request->query();
        $registration_reports = State::search($request->all())->get();

        // dd($registration_reports[0]);
        // dd($registration_reports);
        $export = new CollectiveDetailsExport($registration_reports);
        $fileName = 'collective_details.xlsx';

        return Excel::download($export, $fileName);
    }

    public function showCollectives (Request $request) 
    {

        $registration_reports = State::search($request->all())->paginate(30);

        // dd($registration_reports[0]);

        $page_title = "एकीकृत विवरण";
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();

        session()->flashInput($request->input());

        $grandTotalRegistrationCount = District::getGrandTotalRegistrationCountForStates();
        $grandTotalUnderDiscussionCount = District::getGrandTotalUnderDiscussionCountForStates();

        return view('admin.reports.intrigated_collectiveshow', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'grandTotalRegistrationCount', 'grandTotalUnderDiscussionCount'))->withInput($request->input());
    }


    //R-3
    public function intrigatedNoTransactionDetails(Request $request)
    {
        // Retrieve all registrations along with their related data
        $registration_reports = State::search($request->all())->paginate(30);
        //dd($registration_reports);
        $page_title = "लिनदिननपर्ने फरछयौट एकीकृत";
        $noTransactionPurposes = NoTransactionPurpose::all();
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.intrigated_no_transaction_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'noTransactionPurposes'))->withInput($request->input());
    }

    public function showintrigatedNoTransactionDetails(Request $request)
    {
        // Retrieve all registrations along with their related data
        $registration_reports = State::search($request->all())->paginate(30);
        //dd($registration_reports);
        $page_title = "लिनदिननपर्ने फरछयौट एकीकृत";
        $noTransactionPurposes = NoTransactionPurpose::all();
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.intrigated_no_transaction_detailsshow', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title', 'noTransactionPurposes'))->withInput($request->input());
    }



    public function exportIntrigatedNoTransactionDetails(Request $request)
    {
        // $searchParams = $request->query();
        $registration_reports = State::search($request->all())->get();

        // dd($registration_reports[0]);
        // dd($registration_reports);
        $export = new IntrigatedNoTransactionDetailsExport($registration_reports);
        $fileName = 'intrigated_no_transaction_details.xlsx';

        return Excel::download($export, $fileName);
    }


    //R-4
    public function intrigatedTransactionDetails(Request $request)
    {
        $registration_reports = State::search($request->all())->paginate(30);

        $page_title = "लिनदिनपर्ने एकीकृत";
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.intrigated_transaction_needed_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title'))->withInput($request->input());
    }

    public function showintrigatedTransactionDetails(Request $request)
    {
        $registration_reports = State::search($request->all())->paginate(30);

        $page_title = "लिनदिनपर्ने एकीकृत";
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        session()->flashInput($request->input());
        return view('admin.reports.intrigated_transaction_needed_detailsshow', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title'))->withInput($request->input());
    }

    public function exportIntrigatedTransactionNeededDetails(Request $request)
    {
        // $searchParams = $request->query();
        $registration_reports = State::search($request->all())->get();

        // dd($registration_reports[0]);
        // dd($registration_reports);
        $export = new IntrigatedTransactionNeededDetailsExport($registration_reports);
        $fileName = 'intrigated_transaction_neded_details.xlsx';

        return Excel::download($export, $fileName);
    }
}
