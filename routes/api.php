<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
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

Route::middleware('jwt.auth')->group(function () {

    Route::post('create-class', [SchoolClassController::class, 'store']);
    Route::get('classes', [SchoolClassController::class, 'getClasses']);
    Route::get('class/{class}', [SchoolClassController::class, 'getClass']);
    Route::put('update-class/{id}', [SchoolClassController::class, 'update']);
    Route::delete('delete-class/{id}', [SchoolClassController::class, 'delete']);

    Route::post('create-student', [StudentController::class, 'store']);
    Route::get('students', [StudentController::class, 'getStudents']);
    Route::get('student/{id}', [StudentController::class, 'getStudent']);
    Route::get('students-from-class/{class}', [StudentController::class, 'getStudentsFromClass']);
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

    Route::post('set-mark', [MarkController::class, 'store']);
    Route::get('marks', [MarkController::class, 'getMarks']);
    Route::get('student-marks/{student_id}', [MarkController::class, 'getStudentMarks']);
    Route::get(
        'student-marks/student/{student_id}/subject/{subject_id}',
        [MarkController::class, 'getMarksFromStudentAndSubject']
    );
    Route::put('update-mark/{id}', [MarkController::class, 'update']);
    Route::delete('delete-mark/{id}', [MarkController::class, 'delete']);
});
