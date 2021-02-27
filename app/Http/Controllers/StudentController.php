<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function getStudents() {
        $students = DB::table('students')->get();
        return $students;
    }

    public function getStudentsFromClass($className) {
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
        return $students;
    }
}
