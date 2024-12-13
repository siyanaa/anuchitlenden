<?php

namespace App\Http\Controllers;

use App\Models\Purpose;
use Illuminate\Http\Request;

class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purposes = Purpose::latest()->get();
        $page_title = 'लेनदेनको प्रयोजन';

        return view('admin.purpose.index', compact('purposes', 'page_title'));
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
            'title' => 'required|string|max:255',

        ]);

        try {

            Purpose::create($validatedData);

            return redirect()->route('admin.purpose.index')->with('success', 'Purpose Was Created');
        } catch (\Throwable $th) {

            return redirect()->route('admin.purpose.index')->with('error', 'Purpose Store Failed');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',

        ]);

        try {

            $purpose = Purpose::findOrFail($id);

            $purpose->update($validatedData);
            // Purpose::update($validatedData);

            return redirect()->route('admin.purpose.index')->with('success', 'Purpose Was Updated');
        } catch (\Throwable $th) {

            return redirect()->route('admin.purpose.index')->with('error', 'Purpose Failed to Update');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {

            $purpose = Purpose::findOrFail($id);

            $purpose->delete();

            return redirect()->route('admin.purpose.index')->with('success', 'Purpose Was Deleted');
        } catch (\Throwable $th) {

            return redirect()->route('admin.purpose.index')->with('error', 'Purpose Failed to Delete');
        }
    }
}
