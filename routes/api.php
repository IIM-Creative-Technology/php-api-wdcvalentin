<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('create-student', [StudentController::class, 'store']);
Route::get('students', [StudentController::class, 'getStudents']);
Route::get('studentsFromClass/{class}', [StudentController::class, 'getStudentsFromClass']);
Route::put('update-student/{id}', [StudentController::class, 'update']);
Route::delete('delete-student/{id}', [StudentController::class, 'delete']);

Route::post('create-teacher', [TeacherController::class, 'store']);
Route::get('teachers', [TeacherController::class, 'getAllTeachers']);
Route::get('teacher/{id}', [TeacherController::class, 'getTeacher']);
Route::put('update-teacher/{id}', [TeacherController::class, 'update']);
Route::delete('delete-teacher/{id}', [TeacherController::class, 'delete']);

Route::post('create-subject', [SubjectController::class, 'store']);
Route::get('subjects', [SubjectController::class, 'getSubjects']);
Route::get('subject/{name}', [SubjectController::class, 'getSubject']);
Route::put('update-subject/{id}', [SubjectController::class, 'update']);
Route::delete('delete-subject/{id}', [SubjectController::class, 'delete']);

// Route::middleware('jwt.auth')->group(function () {
//     Route::get()
// })