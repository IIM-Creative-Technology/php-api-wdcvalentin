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
            'arrival_date' => ['date', 'required']
        ]);
        $teacher = new Teacher();
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->arrival_date = date("F j, Y");
        $teacher->save();
        return response()->json([
            'message' => 'Teacher created with success',
            'status' => 201
        ], 201);
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
            'message' => 'Teacher updated with success',
            'status' => 200
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
        return response()->json([
            'message' => 'Teachers fetched with success',
            'data' => $teachers
        ], 200);
    }

    public function getTeacher($id) {
        $teacher = Teacher::select(['first_name', 'last_name', 'arrival_date'])->findOrFail($id);
        return response()->json([
            'message' => 'Teacher fetched with success',
            'status' => 200,
            'data' => $teacher
        ], 200);;
    }

    public function delete($id) {
        $isTeacherExist = DB::table('teachers')
        ->where('teachers.id', $id)
        ->get();
        if (empty($isTeacherExist[0])) {
            return response()->json([
                'message' => 'Teacher not found',
                'status' => 400
            ], 400);
        }
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return response()->json([
            'message' => 'Teacher deleted with success'
        ], 200);
    }
}
