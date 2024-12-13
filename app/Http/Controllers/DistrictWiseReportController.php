<?php

namespace App\Http\Controllers;

use App\Models\Proof;
use App\Models\State;
use App\Models\Nature;
use App\Models\Purpose;
use App\Models\District;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistrictWiseReportController extends Controller
{
    
    public function districtWiseRegistration(Request $request)
    {
        Auth::user(); // Fetch the authenticated user

        $registration_reports = Registration::search($request->all())->paginate(10);
        //dd($registration_reports);
        $page_title = 'Registration Listing';

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();

        return view('admin.reports.registration_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title'))->withInput($request->input());
    }

    public function releaseDetails(Request $request)
    {

        Auth::user(); // Fetch the authenticated user

        // Retrieve all registrations along with their related data
        $registration_reports = Registration::search($request->all())->paginate(10);
        //dd($registration_reports);
        $page_title = 'Release Details Listing';

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        return view('admin.reports.release_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title'))->withInput($request->input());
    }


    public function agreementNoImplementationDetails(Request $request)
    {

        Auth::user(); // Fetch the authenticated user

        // Retrieve all registrations along with their related data
        $registration_reports = Registration::search($request->all())->paginate(10);
        //dd($registration_reports);
        $page_title = "Agreement But No Implementation Details";


        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        return view('admin.reports.agreement_no_implementation_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title'))->withInput($request->input());
    }

    public function noAgreementOnDiscussionDetails(Request $request)
    {

        Auth::user(); // Fetch the authenticated user

        // Retrieve all registrations along with their related data
        $registration_reports = Registration::search($request->all())->paginate(10);
        $page_title = "No Agreement on Discussion Details";


        return view('admin.reports.no-agreement-on-discussion-details', compact('page_title'));
    }

    public function collectives(Request $request)
    {
        Auth::user(); // Fetch the authenticated user

        $registration_reports = State::search($request->all())->paginate(10);

        $page_title = "Integrated / Collective All Details";
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();

        return view('admin.reports.intrigated_collective', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title'))->withInput($request->input());
    }

    public function underDiscussionDetails(Request $request)
    {

        Auth::user(); // Fetch the authenticated user

        // Retrieve all registrations along with their related data
        $registration_reports = Registration::search($request->all())->paginate(10);
        $page_title = "Under Discussion - Details";

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        return view('admin.reports.under_discussion_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title'))->withInput($request->input());
    }

    //R-3
    public function intrigatedNoTransactionDetails(Request $request)
    {
        Auth::user(); // Fetch the authenticated user

        // Retrieve all registrations along with their related data
        $registration_reports = State::search($request->all())->paginate(10);
        //dd($registration_reports);
        $page_title = "Integrated No Transaction - Details";

        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();
        return view('admin.reports.intrigated_no_transaction_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title'))->withInput($request->input());
    }

    //R-4
    public function intrigatedTransactionDetails(Request $request)
    {

        Auth::user(); // Fetch the authenticated user

        $registration_reports = State::search($request->all())->paginate(10);

        $page_title = "Integrated Transaction - Details";
        $states = State::select('name', 'id')->get();
        $districts = District::select('name', 'id')->get();
        $natures = Nature::select('title', 'id')->get();
        $proofs = Proof::select('title', 'id')->get();
        $purposes = Purpose::select('title', 'id')->get();

        return view('admin.reports.intrigated_transaction_needed_details', compact('registration_reports', 'proofs', 'natures', 'purposes', 'states', 'page_title'))->withInput($request->input());
    }
}
