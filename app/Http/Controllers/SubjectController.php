<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['min: 3', 'max:255', 'required'],
            'week_date' => ['date', 'required'],
            'teacher' => ['min: 3', 'required'],
            'school_class' => ['min: 2, required']
        ]);
        $school_classId = DB::table('school_classes')
            ->where('name', $request->school_class)
            ->select('school_classes.id')
            ->get();
        $teacher_id = DB::table('teachers')
            ->where('first_name', $request->teacher)
            ->select('teachers.id')
            ->get();
        if (count($school_classId) === 0 || count($teacher_id) === 0) {
            return response()->json([
                'message' => 'could not understand request due to invalid syntax',
                'values' => [
                    'school_class' => $school_classId,
                    'teacher' => $teacher_id
                ]
            ], 400);
        }
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->week_date = $request->week_date;
        $subject->teacher_id = $teacher_id[0]->id;
        $subject->schoolclass_id = $school_classId[0]->id;
        $subject->save();

        return response()->json([
            'message' => 'Subject created with success'
        ], 201);
    }
    public function getSubjects()
    {
        $subjects = DB::table('subjects')
            ->select(
                'subjects.name',
            )
            ->get();
        return response()->json([
            'status' => 200,
            'data' => $subjects,
        ], 200);
    }
    public function update($id, Request $request)
    {
        $subject = Subject::findOrFail($id);
        $schoolclass_id = DB::table('school_classes')
            ->where('school_classes.name', $request->school_class)
            ->select('school_classes.id')
            ->get();
        $teacher_id = DB::table('teachers')
            ->where('teachers.first_name', $request->teacher)
            ->select('teachers.id')
            ->get();
        if (empty($schoolclass_id[0]) || empty($teacher_id[0])) {
            return response()->json([
                'message' => 'class or teacher not existing',
            ], 400);
        }
        $request->validate([
            'name' => ['min: 3', 'max:255', 'required'],
            'week_date' => ['date', 'required'],
            'school_class' => ['min: 3', 'max:255', 'required'],
            'teacher' => ['min: 3', 'max:255', 'required'],
        ]);
        $subject->name = $request->name;
        $subject->week_date = $request->week_date;
        $subject->teacher_id = $teacher_id[0]->id;
        $subject->schoolclass_id = $schoolclass_id[0]->id;
        $subject->save();

        return response()->json([
            'message' => 'Subject updated with success'
        ], 200);
    }

    public function delete($id)
    {
        $subject = DB::table('subjects')
        ->where('subjects.id', $id)
        ->get();
        if (empty($subject[0])) {
            return response()->json([
                'message' => 'Subject not found',
                'status' => 400
            ], 400);
        }
        $subject = subject::findOrFail($id);
        $subject->delete();
        return response()->json([
            'message' => 'subject deleted with success'
        ], 200);
    }
}
