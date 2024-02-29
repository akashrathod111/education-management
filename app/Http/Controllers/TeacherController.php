<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Standerd;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //user_type == 0 admin and 1 teacher
        $teachers = Teacher::with(['standerd','subject'])->whereHas('user', function ($query) {
            $query->where('user_type', 1);
        })->with('user')->latest()->paginate(5);

        return view('admin.pages.teacher.index',compact('teachers'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $standers = Standerd::get()->pluck('name', 'id');
        $subjects = Subject::get()->pluck('name', 'id');
        return view('admin.pages.teacher.create',compact('standers','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'subject_id' => 'required|numeric',
            'standerd_id' => 'required|numeric',
        ]);

        $params = $request->all();

        $user = User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => bcrypt($params['password']),
            'user_type' => 1,
        ]);
        
        // Create a new Teacher instance
        $teacher = new Teacher([
            'subject_id' => $params['subject_id'],
            'standerd_id' => $params['standerd_id'],
        ]);
        
        // Save the Teacher instance
        $user->teacher()->save($teacher);
         
        return redirect()->route('teacher.index')
                        ->with('success','Teacher created successfully.');
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
    public function edit(Teacher $teacher)
    {
        $standers = Standerd::get()->pluck('name', 'id');
        $subjects = Subject::get()->pluck('name', 'id');
        return view('admin.pages.teacher.edit',compact('teacher','standers','subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject_id' => 'required|numeric',
            'standerd_id' => 'required|numeric',
        ];

        if ($request->has('password')) {
            $rules['password'] = 'required';
        }

        $request->validate($rules);

        $params = $request->all();
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('teacher.index')->with('error', 'Teacher not found.');
        }
        
        $teacher = Teacher::where('id', $id)->first();
        
        if (!$teacher) {
            return redirect()->route('teacher.index')->with('error', 'Teacher not found.');
        }
        
        $user->name = $params['name'];
        $user->email = $params['email'];
        if (!empty($params['password'])) {
            $user->password = bcrypt($params['password']);
        }
        
        $user->save();

        $teacher->subject_id = $params['subject_id'];
        $teacher->standerd_id = $params['standerd_id'];
        $teacher->save();

        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('teacher.index')->with('error', 'Teacher not found.');
        }

        $teacher = Teacher::where('id', $id)->first();

        if (!$teacher) {
            return redirect()->route('teacher.index')->with('error', 'Teacher not found.');
        }

        $teacher->delete();

        $user->delete();

        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully.');
    }
}
