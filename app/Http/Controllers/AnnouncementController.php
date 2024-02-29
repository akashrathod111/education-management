<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendAnnouncementEmail;
use App\Models\Announcement;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
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
        $user = auth()->user();
        if ($user->user_type == 1) {
            $announcements = Announcement::where('user_type',1)->latest()->paginate(5);
        }else{
            $announcements = Announcement::latest()->paginate(5);
        }
        
        return view('admin.pages.announcement.index', compact('announcements'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::with(['standerd', 'subject'])->whereHas('user', function ($query) {
            $query->where('user_type', 1);
        })->with('user')->get()->pluck('user.name', 'user.id');
        $student = Student::get()->pluck('name', 'id');
        return view('admin.pages.announcement.create', compact('teachers', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'student_id' => 'nullable|array',
            'student_id.*' => 'exists:students,id',
            'teacher_id' => 'nullable|array',
            'teacher_id.*' => 'exists:teachers,id',
        ]);
        $params = $request->all();

        $announcement = Announcement::create([
            'name' => $params['name'],
            'description' => $params['description'],
            'teacher_id' => $params['teacher_id'] ?? [],
            'student_id' => $params['student_id'] ?? [],
            'user_type' => auth()->user()->user_type,
        ]);

        $user = auth()->user();
        if ($user->user_type == 1) {        
            if ($announcement) {
              $student =  Student::with('parent')->WhereIn('id',$params['student_id'])->get()->toArray(); 
              foreach ($student as $value) {
                   SendAnnouncementEmail::dispatch($value,$params);
              }         
           }
        }

        return redirect()->route('announcement.index')
            ->with('success', 'Announcement created successfully.');
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
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('announcement.index')
            ->with('success', 'Announcement deleted successfully');
    }
}
