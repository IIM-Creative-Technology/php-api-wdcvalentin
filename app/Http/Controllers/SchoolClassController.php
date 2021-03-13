<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolClassController extends Controller
{
    public function store(Request $request)
    {
        if ($request->year > 2100) {
            return response()->json([
                'message' => 'Year is not correct',
            ], 400);
        }
        $request->validate([
            'name' => ['min: 3', 'max:255', 'required'],
            'year' => ['min: 3', 'max:255', 'required'],
        ]);
        $class = new SchoolClass();
        $class->name = $request->name;
        $class->year = $request->year;
        $class->save();
        return response()->json([
            'message' => 'class created with success',
        ], 201);
    }

    public function getClasses()
    {
        $classes = DB::table('school_classes')->get();
        return response()->json([
            'message' => 'Classes fetched with success',
            'data' => $classes
        ], 200);
    }

    public function getClass($name)
    {
        $isClassExist = DB::table('school_classes')
            ->where('school_classes.name', $name)
            ->get();

        if (empty($isClassExist[0])) {
            return response()->json([
                'Error' => 'className does not exist'
            ], 400);
        }

        return response()->json([
            'message' => ' Class fetched with success',
            'data' => $isClassExist,
        ], 200);
    }

    public function update($id, Request $request)
    {
        $class = SchoolClass::findOrFail($id);

        if (empty($class)) {
            return response()->json([
                'message' => 'class does not exist',
            ], 400);
        }

        if ($request->year > 2100) {
            return response()->json([
                'message' => 'Year is not correct',
            ], 401);
        }

        $request->validate([
            'name' => ['min: 3', 'max:255', 'required'],
            'year' => ['min: 3', 'max:255', 'required'],
        ]);
        $class->name = $request->name;
        $class->year = $request->year;
        $class->save();

        return response()->json([
            'message' => 'Class updated with success'
        ], 200);
    }

    public function delete($id)
    {
        $isClassExist = DB::table('school_classes')
            ->where('school_classes.id', $id)
            ->get();
        if (empty($isClassExist[0])) {
            return response()->json([
                'message' => 'Class not found'
            ], 400);
        }
        $class = SchoolClass::findOrFail($id);
        $class->delete();
        return response()->json([
            'message' => 'Class deleted with success'
        ], 200);
    }
}
