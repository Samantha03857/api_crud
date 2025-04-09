<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        $data = [
            'teachers' => $teachers,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'grade' => 'required|max:255',
            'specialist' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $teacher = Teacher::create([
            'name' => $request->name,
            'grade' => $request->grade,
            'specialist' => $request->specialist
        ]);

        if (!$teacher) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'teacher' => $teacher,
            'status' => 201
        ];

        return response()->json($data, 201);

    }

    public function show($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'teacher' => $teacher,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $teacher->delete();

        $data = [
            'message' => 'Profesor eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'grade' => 'required|max:255',
            'specialist' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $teacher->name = $request->name;
        $teacher->grade = $request->grade;
        $teacher->specialist = $request->specialist;

        $teacher->save();

        $data = [
            'message' => 'Profesor actualizado',
            'teacher' => $teacher,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function updatePartial(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'grade' => 'required|max:255',
            'specialist' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('name')) {
            $teacher->name = $request->name;
        }

        if ($request->has('grade')) {
            $teacher->grade = $request->grade;
        }

        if ($request->has('specialist')) {
            $teacher->specialist = $request->specialist;
        }

        $teacher->save();

        $data = [
            'message' => 'Profesor actualizado',
            'student' => $teacher,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

}