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

Route::get('students', [StudentController::class, 'getStudents']);
Route::get('students/{class}', [StudentController::class, 'getStudentsFromClass']);


Route::post('create-teacher', [TeacherController::class, 'store']);
Route::put('update-teacher/{id}', [TeacherController::class, 'update']);
Route::get('teachers', [TeacherController::class, 'getAllTeachers']);
Route::get('teacher/{id}', [TeacherController::class, 'getTeacher']);

Route::post('create-subject', [SubjectController::class, 'store']);

// Route::middleware('jwt.auth')->group(function () {
//     Route::get()
// })