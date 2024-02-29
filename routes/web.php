<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::resource('standerd', App\Http\Controllers\StanderdController::class);
Route::resource('subject', App\Http\Controllers\SubjectController::class);
Route::resource('teacher', App\Http\Controllers\TeacherController::class);
Route::resource('parent', App\Http\Controllers\StudentParentController::class);
Route::resource('student', App\Http\Controllers\StudentController::class);
Route::resource('announcement', App\Http\Controllers\AnnouncementController::class);