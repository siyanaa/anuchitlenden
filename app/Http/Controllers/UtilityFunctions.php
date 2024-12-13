<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\History;
use App\Models\District;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\LocalGovernment;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class UtilityFunctions{

   static function getUserIP() {

        $ipaddress = '';

        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
            
        return $ipaddress;
    }


    static function search(Request $request)
    {
        DB::enableQueryLog();
        // Perform the search based on user input
        $searchTerm = $request->input('query');

        $searchResults = Registration::where(function ($query) use ($searchTerm) {
            $query->where('registration_id', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('applicant', function ($query) use ($searchTerm) {
                    $query->where('full_name', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('offender', function ($query) use ($searchTerm) {
                    $query->where('full_name', 'like', '%' . $searchTerm . '%');
                });
        })
        ->when(User::isAdmin(), function ($query) {
            return $query->where('register_by', Auth::user()->id);
        })
        ->get();
            //dd(DB::getQueryLog());
        // Return the search results as HTML
        $html = '';
        foreach ($searchResults as $result) {
            $html .= '<a class="dropdown-item fs--1 px-x1 py-1 hover-primary" id="registration-id" href="#" data-value="' . $result->registration_id . '"  data-id="' . $result->id . '"><i class="fa-sharp fa-solid fa-circle-check">' . $result->registration_id . '(applicant-' . $result->applicants_names . ' offenders-' . $result->offenders_names . ' )</i></a><hr class="text-200 dark__text-900">';
        }
        return $html;
        // Return the result as a JSON response
        return response()->json(['results' => $searchResults]);
    }
    
    
    static function searchDistrict(Request $request)
    {
        // Perform the search based on user input
        $searchTerm = $request->input('query');

        //$results = Registration::where('registration_id', 'like', '%' . $searchTerm . '%')->pluck('registration_id');

        $results = District::where('id', 'like', '%' . $searchTerm . '%')
            ->orWhere('name', 'like', '%' .$searchTerm . '%')->get();

        // Return the search results as HTML
        $html = '';
        foreach ($results as $result) {
            $html .= '<a class="dropdown-item fs--1 px-x1 py-1 hover-primary" id="registration-id" href="#" data-id="' . $result->id . '"><i class="fa-sharp fa-solid fa-circle-check">' . $result->name . '</i></a><hr class="text-200 dark__text-900">';
        }
        return $html;
        // Return the result as a JSON response
        return response()->json(['results' => $results]);
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

    static function getRole(){

        if ( User::isSuperSuperAdmin() ) {
            $role = Role::with('permissions')->get();
        }elseif(User::isSuperAdmin()){
            $role = Role::with('permissions')->whereNotIn('id', [1, 2])->get();
        }else {
            $role = Role::with('permissions')->whereNotIn('id', [1, 2])->get();
        }
        return $role;
    }

    // if ( User::isSuperAdmin() ) {
    //     $role = Role::with('permissions')->whereNotIn('id', [1])->get();
    // }elseif (User::isSuperSuperAdmin()) {
    //     $role = Role::with('permissions')->whereNotIn('id', [1])
    // }else {
    //     $role = Role::with('permissions')->whereNotIn('id', [1, 2])->get();
    // }
    // return $role;

    static function createHistory($message, $type)
    {
        History::create([
            'description' => $message,
            'user_id' => Auth::user()->id,
            'type' => $type,
            'ip_address' => UtilityFunctions::getUserIP(),
        ]);
    }

    static function getEmptyName($input)
    {
        return (!isset($input) || trim($input) === '') ? null : $input;
    }

    static function customPaginate($currentPage,$array,$perPage,$request){

        $itemCollection = collect($array);

        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        $paginatedItems->setPath($request->url());

        return $paginatedItems;
    }


}