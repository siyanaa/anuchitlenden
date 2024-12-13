<?php

namespace App\Http\Controllers;

use App\Models\CountData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class CountController extends Controller
{
    public function index() 
    {

        // Get the currently authenticated user
        $user = Auth::user();

        // Check the user's role
        if ($user->role == 1 || $user->role == 2) {
            // Admin users with role 1 or 2 can view all count data
            $counts = CountData::latest()->get();
        }
        if ($user->role == 3) {
            $counts = CountData::with(['user.district'])
                ->where('register_by', $user->id)
                ->latest()
                ->get();

            // dd($counts);
        }

        return view('admin.count.index', compact('counts'));
    }

    public function create() 
    {
        return view('admin.count.create');
    }

    public function store(Request $request) 
    {

        $request->validate([
            'registration_count' => 'required',
            'discussions_count' => 'required',
            'no_agreement_discussions_count' => 'required',
            'releases_count' => 'required',
        ]);


        try {
            $user = Auth::user();
            $count = new CountData();
            $count->registration_count = $request->registration_count;
            $count->discussions_count = $request->discussions_count;
            $count->no_agreement_discussions_count = $request->no_agreement_discussions_count;
            $count->releases_count = $request->releases_count;
            $count->register_by = $user->id;

            $count->save();

            return redirect()->route('admin.count.index')->with('success', 'सिर्जना भएको छ ');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return view('admin.count.index');
    }


    public function edit($id)
    {
        $count = CountData::find($id);
        return view('admin.count.update', compact('count'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'registration_count' => 'required',
            'discussions_count' => 'required',
            'no_agreement_discussions_count' => 'required',
            'releases_count' => 'required',
        ]);

        try {

            $user = Auth::user();

            $count = CountData::find($request->id);
            $count->registration_count = $request->registration_count;
            $count->discussions_count = $request->discussions_count;
            $count->no_agreement_discussions_count = $request->no_agreement_discussions_count;
            $count->releases_count = $request->releases_count;
            $count->register_by = $user->id;
    
            if ($count->save()) {
                return redirect()->route('admin.count.index')->with('success', 'सम्पादन भएको छ ');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
