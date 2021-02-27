<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'first_name' => ['min: 3', 'max:255', 'required'],
            'last_name' => ['min: 3', 'max:255', 'required'],
            'arrival_date' => 'required'
        ]);
        $teacher = new Teacher();
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->arrival_date = date("F j, Y, g:i a");
        $teacher->save();
        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function update(Request $request, $id) {
        $teacher = Teacher::findOrFail($id);
        $request->validate([
            'first_name' => ['min: 3', 'max:255', 'required'],
            'last_name' => ['min: 3', 'max:255', 'required'],
            'arrival_date => required'
        ]);
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->arrival_date = $request->arrival_date;
        $teacher->save();

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function getAllTeachers() {
        $teachers = DB::table('teachers')
                        ->select(
                            'teachers.first_name',
                            'teachers.last_name',
                            'teachers.arrival_date'
                            )
                        ->get();
        return $teachers;
    }

    public function getTeacher($id) {
        $teacher = Teacher::select(['first_name', 'last_name', 'arrival_date'])->findOrFail($id);
        return $teacher;
    }
}
