<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->user_type == 1) {
            $announcements = Announcement::where(function ($query) use ($user) {
                $query->whereJsonContains('teacher_id', (string)$user->id)
                    ->orWhereJsonContains('teacher_id', [$user->id]);
            })
            ->latest()
            ->paginate(5);
        } else {
            $announcements = Announcement::latest()->paginate(5);
        }

        return view('admin.pages.dashboard', compact('announcements'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
