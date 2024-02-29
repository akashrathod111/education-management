<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Standerd;
use Illuminate\Http\Request;

class StanderdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $standerds = Standerd::latest()->paginate(5);
        return view('admin.pages.standerd.index',compact('standerds'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.standerd.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'class' => 'required',
        ]);
        
        Standerd::create($request->all());
         
        return redirect()->route('standerd.index')
                        ->with('success','Standerd created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Standerd $standerd)
    {
        return view('admin.pages.standerd.edit',compact('standerd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Standerd $standerd)
    {
        $request->validate([
            'name' => 'required',
            'class' => 'required',
        ]);
        
        $standerd->update($request->all());
        
        return redirect()->route('standerd.index')
                        ->with('success','Standerd updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Standerd $standerd)
    {
        $standerd->delete();
         
        return redirect()->route('standerd.index')
                        ->with('success','Standerd deleted successfully');
    }
}
