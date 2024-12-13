<?php

namespace App\Http\Controllers;

use App\Models\NoTransactionPurpose;
use Illuminate\Http\Request;

class NoTransactionPurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noTransactionPurpose = NoTransactionPurpose::latest()->get();
        $page_title = 'लिन दिन नपर्ने गरी फर्छ्यौट';

        return view('admin.notransactionpurpose.index', compact('noTransactionPurpose', 'page_title'));
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
            'title' => 'required|string|max:500',
          
        ]);

        try {

            NoTransactionPurpose::create($validatedData);

            return redirect()->route('admin.notransactionpurpose.index')->with('success', 'No Transaction Purpose Was Created');
        } catch (\Throwable $th) {

            return redirect()->route('admin.notransactionpurpose.index')->with('error', 'No Transaction Purpose Store Failed');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NoTransactionPurpose  $noTransactionPurpose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
          
        ]);

        try {

            $noTransactionPurpose = NoTransactionPurpose::findOrFail($id);

            $noTransactionPurpose->update($validatedData);

            return redirect()->route('admin.notransactionpurpose.index')->with('success', 'No Transaction Purpose Was Updated');

        } catch (\Throwable $th) {

            return redirect()->route('admin.notransactionpurpose.index')->with('error', 'No Transaction Purpose Failed to Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoTransactionPurpose  $noTransactionPurpose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {

            $noTransactionPurpose = NoTransactionPurpose::findOrFail($id);

            $noTransactionPurpose->delete();

            return redirect()->route('admin.notransactionpurpose.index')->with('success', 'No Transaction Purpose was Deleted');

        } catch (\Throwable $th) {

            return redirect()->route('admin.notransactionpurpose.index')->with('error', 'No Transaction Purpose to Delete');
        }

    }
}
