<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentParent;
use Illuminate\Http\Request;

class StudentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentParent = StudentParent::latest()->paginate(5);
        return view('admin.pages.parent.index',compact('studentParent'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.parent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        StudentParent::create($request->all());
         
        return redirect()->route('parent.index')
                        ->with('success','Parent created successfully.');
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
    public function edit($id)
    {
        $studentParent = StudentParent::findOrFail($id);
        return view('admin.pages.parent.edit',compact('studentParent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $studentParent = StudentParent::findOrFail($id);
        $studentParent->update($request->all());
        
        return redirect()->route('parent.index')
                        ->with('success','Parent updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $studentParent = StudentParent::findOrFail($id);
        $studentParent->delete();
         
        return redirect()->route('parent.index')
                        ->with('success','Parent deleted successfully');
    }
}
