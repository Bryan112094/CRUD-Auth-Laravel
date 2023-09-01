<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{
    public function index()
    {
        $departaments = Departament::all();
        return response()->json($departaments);
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required|string|min:1|max:100'];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $departament = new Departament($request->input());
        $departament->save();
        return response()->json([
            'status' => true,
            'message' => 'Departament created successfully'
        ], 200);
    }

    public function show(Departament $departament)
    {
        return response()->json(['status' => true, 'data' => $departament]);
    }

    public function update(Request $request, Departament $departament)
    {
        $rules = ['name' => 'required|string|min:1|max:100'];
        $validator = \Validator::make($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $departament->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Departament updated successfully'
        ], 200);
    }

    public function destroy(Departament $departament)
    {
        $departament->delete();
        return response()->json([
            'status' => true,
            'message' => 'Departament deleted successfully'
        ], 200);
    }
}
