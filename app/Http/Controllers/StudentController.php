<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StdClass;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_data = StdClass::all();
        return response()->json($student_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'class_name' => 'required|max:255|unique:std_classes',
        ]);

        $data = array();
        $data['class_name'] = $request->class_name;
        $insert = DB::table('std_classes')->insert($data);
        return response()->json("Student Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student_data = StdClass::find($id);
        return response()->json($student_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'class_name' => 'required|max:255|unique:std_classes',
        ]);
        $data = array();
        $data['class_name'] = $request->class_name;
        $student_data = StdClass::find($id);
        $student_data->update($data);

        return response()->json("Student Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StdClass::find($id)->delete();
        return response()->json("Student Deleted");
    }
}
