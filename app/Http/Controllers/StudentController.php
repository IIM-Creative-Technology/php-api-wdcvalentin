<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'first_name' => ['min: 3', 'max:255', 'required'],
            'last_name' => ['min: 3', 'max:255', 'required'],
            'age' => 'required',
            'class' => 'required'
        ]);
        $schoolclass_id = DB::table('school_classes')
            ->where('school_classes.name', $request->class)
            ->select('school_classes.id')
            ->get();
        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->age = $request->age;
        $student->class = $request->class;
        $student->schoolclass_id = $schoolclass_id[0]->id;
        $student->save();
        return response()->json([
            'message' => 'student created with success',
        ], 201);
    }

    public function getStudents()
    {
        $students = DB::table('students')->get();
        return response()->json([
            'message' => 'Students fetched with success',
            'data' => $students
        ], 200);
    }

    public function getStudentsFromClass($className)
    {
        $isClassExist = DB::table('school_classes')
            ->where('school_classes.name', $className)
            ->get();

        if (empty($isClassExist[0])) {
            return response()->json([
                'Error' => 'className does not exist'
            ], 400);
        }

        $students = DB::table('students')
            ->join('school_classes', 'students.schoolclass_id', '=', 'school_classes.id')
            ->where('school_classes.name', $className)
            ->select(
                'students.first_name',
                'students.last_name',
                'students.class',
                'students.age'
            )
            ->get();

        return response()->json([
            'data' => $students,
            'message' => 'Students from the class : ' . $className . ' fetched with success'
        ], 200);
    }

    public function update($id, Request $request) {
        $student = Student::findOrFail($id);
        $schoolclass_id = DB::table('school_classes')
            ->where('school_classes.name', $request->class)
            ->select('school_classes.id')
            ->get();
        if (empty($schoolclass_id[0])) {
            return response()->json([
                'message' => 'class does not exist',
            ], 400);
        }
        $request->validate([
            'first_name' => ['min: 3', 'max:255', 'required'],
            'last_name' => ['min: 3', 'max:255', 'required'],
        ]);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->age = $request->age;
        $student->class = $request->class;
        $student->schoolclass_id = $schoolclass_id[0]->id;
        $student->save();

        return response()->json([
            'message' => 'Student updated with success'
        ], 200);
    }

    public function delete($id) {
        $isStudentExist = DB::table('students')
        ->where('students.id', $id)
        ->get();
        if (empty($isStudentExist[0])) {
            return response()->json([
                'message' => 'Student not found'
            ], 400);
        }
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json([
            'message' => 'Student deleted with success'
        ], 200);
    }
}
