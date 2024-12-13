<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;

class NatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $natures = Nature::latest()->get();
        $page_title = 'लेनदेनको प्रकृती';

        return view('admin.nature.index', compact('natures', 'page_title'));
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
            'type' => 'required|string|max:255',

        ]);

        try {

            Nature::create($validatedData);

            return redirect()->route('admin.nature.index')->with('success', 'Nature Was Created');
        } catch (\Throwable $th) {

            return redirect()->route('admin.nature.index')->with('error', 'Nature Store Failed');
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
            'type' => 'required|string|max:255',
        ]);

        try {

            $nature = Nature::findOrFail($id);

            $nature->update($validatedData);

            return redirect()->route('admin.nature.index')->with('success', 'Nature Was Updated');
        } catch (\Throwable $th) {

            return redirect()->route('admin.nature.index')->with('error', 'Nature Failed to Update');
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

            $nature = Nature::findOrFail($id);

            $nature->delete();

            return redirect()->route('admin.nature.index')->with('success', 'Nature Was Deleted');
        } catch (\Throwable $th) {

            return redirect()->route('admin.purpose.index')->with('error', 'Nature Failed to Delete');
        }
    }
}
