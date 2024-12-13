<?php

namespace App\Http\Controllers;

use App\Models\Proof;
use Illuminate\Http\Request;

class ProofController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proofs = Proof::latest()->get();
        $page_title = 'लेनदेनको प्रमाण';

        return view('admin.proof.index', compact('proofs', 'page_title'));
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

            Proof::create($validatedData);

            return redirect()->route('admin.proof.index')->with('success', 'Proof Was Created');
        } catch (\Throwable $th) {

            return redirect()->route('admin.proof.index')->with('error', 'Proof Store Failed');
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

            $proofs = Proof::findOrFail($id);

            $proofs->update($validatedData);
            // Purpose::update($validatedData);

            return redirect()->route('admin.proof.index')->with('success', 'Proof Was Updated');
        } catch (\Throwable $th) {

            return redirect()->route('admin.proof.index')->with('error', 'Proof Failed to Update');
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

            $proofs = Proof::findOrFail($id);

            $proofs->delete();

            return redirect()->route('admin.proof.index')->with('success', 'Proof Was Deleted');
            
        } catch (\Throwable $th) {

            return redirect()->route('admin.proof.index')->with('error', 'Proof Failed to Delete');
        }
    }
}
