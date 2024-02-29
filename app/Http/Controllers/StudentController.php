<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Standerd;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Http\Request;

class StudentController extends Controller
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
        $students = Student::with(['parent','standerd'])->latest()->paginate(5);
        return view('admin.pages.student.index',compact('students'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $standers = Standerd::get()->pluck('name', 'id');
        $parent = StudentParent::get()->pluck('name', 'id');
        return view('admin.pages.student.create',compact('standers','parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'parent_id' => 'required',
            'standerd_id' => 'required',
        ]);
        
        Student::create($request->all());
         
        return redirect()->route('student.index')
                        ->with('success','Student created successfully.');
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
    public function edit(Student $student)
    {
        $standers = Standerd::get()->pluck('name', 'id');
        $parent = StudentParent::get()->pluck('name', 'id');
        return view('admin.pages.student.edit',compact('student','standers','parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'parent_id' => 'required',
            'standerd_id' => 'required',
        ]);
        
        $student->update($request->all());
        
        return redirect()->route('student.index')
                        ->with('success','Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
         
        return redirect()->route('student.index')
                        ->with('success','Student deleted successfully');
    }
}
