<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    public function store(Request $request)
    {
        if (
            !is_numeric($request->student_id)
            || !is_numeric($request->schoolclass_id)
            || !is_numeric($request->subject_id)
        ) {
            return response()->json([
                'Error' => 'an ID is required to set mark'
            ], 406);
        }
        $student_id = DB::table('students')
            ->where('students.id', $request->student_id)
            ->get();
        $schoolclass_id = DB::table('school_classes')
            ->where('school_classes.id', $request->schoolclass_id)
            ->get();
        $subject_id = DB::table('subjects')
            ->where('subjects.id', $request->subject_id)
            ->get();

        if (empty($student_id[0]) || empty($schoolclass_id[0]) || empty($subject_id)) {
            return response()->json([
                'Error' => 'student or class or subject id does not exist'
            ], 400);
        }

        $request->validate([
            'mark' => 'required|integer|between:1,20',
            'student_id' => 'required|integer|between:1,10000',
            'student_id' => 'required|integer|between:1,10000',
            'subject_id' => 'required|integer|between:1,10000',
        ]);

        $mark = new Mark();
        $mark->mark = $request->mark;
        $mark->student_id = $student_id[0]->id;
        $mark->schoolclass_id = $schoolclass_id[0]->id;
        $mark->subject_id = $subject_id[0]->id;
        $mark->save();
        return response()->json([
            'message' => 'class created with success',
        ], 201);
    }

    public function getMarks()
    {
        $marks = DB::table('marks')->get();
        return response()->json([
            'message' => 'marks fetched with success',
            'data' => $marks
        ], 200);
    }

    public function getStudentMarks($student_id)
    {
        $isStudentExist = DB::table('students')
            ->where('students.id', $student_id)
            ->get();

        if (empty($isStudentExist[0])) {
            return response()->json([
                'Error' => 'Student does not exist'
            ], 400);
        }

        $marksFromStudent = DB::table('marks')
            ->where('marks.student_id', $student_id)
            ->get();

        if (empty($marksFromStudent[0])) {
            return response()->json([
                'message' => ' This student (id : ' . $student_id . ') has no marks',
            ], 200);
        }
        return response()->json([
            'message' => ' Student Marks fetched with success',
            'data' => $marksFromStudent,
        ], 200);
    }

    public function getMarksFromStudentAndSubject($student_id, $subject_id)
    {
        $isStudentExist = DB::table('students')
            ->where('students.id', $student_id)
            ->get();

        $isSubjectExist = DB::table('subjects')
            ->where('subjects.id', $subject_id)
            ->get();

        if (empty($isStudentExist[0]) || empty($isSubjectExist[0])) {
            return response()->json([
                'Error' => 'Student Or Subject does not exist'
            ], 400);
        }

        $marks = DB::table('marks')
            ->where('marks.student_id', $student_id)
            ->where('marks.subject_id', $subject_id)
            ->get();

        if (empty($marks[0])) {
            return response()->json([
                'message' => ' This student (id : ' . $student_id . ') has no marks',
            ], 200);
        }

        return response()->json([
            'message' => ' Student Marks fetched with success',
            'data' => $marks,
        ], 200);
    }

    public function update($id, Request $request)
    {
        $subject = Mark::findOrFail($id);
        $isStudentExist = DB::table('students')
            ->where('students.id', $request->student_id)
            ->get();

        $isSubjectExist = DB::table('subjects')
            ->where('subjects.id', $request->subject_id)
            ->get();

        $isSchoolClassExist = DB::table('school_classes')
            ->where('school_classes.id', $request->schoolclass_id)
            ->get();

        if (empty($isStudentExist[0]) || empty($isSubjectExist[0]) || empty($isSchoolClassExist[0])) {
            return response()->json([
                'message' => 'class or student or subject not existing',
            ], 400);
        }
        $request->validate([
            'mark' => 'required|integer|between:1,20',
            'student_id' => 'required|integer|between:1,10000',
            'schoolclass_id' => 'required|integer|between:1,10000',
            'subject_id' => 'required|integer|between:1,10000',
        ]);
        $subject->mark = $request->mark;
        $subject->student_id = $request->student_id;
        $subject->subject_id = $request->subject_id;
        $subject->schoolclass_id = $request->schoolclass_id;
        $subject->save();

        return response()->json([
            'message' => 'Subject updated with success'
        ], 200);
    }

    public function delete($id)
    {
        $mark = DB::table('marks')
            ->where('marks.id', $id)
            ->get();
        if (empty($mark[0])) {
            return response()->json([
                'message' => 'Mark not found',
                'status' => 400
            ], 400);
        }
        $mark = Mark::findOrFail($id);
        $mark->delete();
        return response()->json([
            'message' => 'Mark deleted with success'
        ], 200);
    }
}
