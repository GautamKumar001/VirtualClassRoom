<?php

namespace App\Http\Controllers;

use App\TeacherModel;
use App\StudentModel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class StudentModelController extends Controller
{
    public function index()
    {
        $authemail=Auth::user()->email;
        $authname=Auth::user()->name;
        return view('StudentView.StudentForm', compact('authemail', 'authname'));
    }
    public function show()
    {
        return view('StudentView.StudentProfile');
    }
    public function store(Request $request)
    {
        $data = (request()->validate(
            [
                'Name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'age' => 'required',
                'institute' => 'required',
                'Identity' => 'required|image',
                'image' => 'required|image',
            ]
        ));

        $student = new StudentModel();
        $student->name = request('Name');
        $student->email = request('email');
        $student->gender = request('gender');
        $student->age = request('age');
        $student->institute = request('institute');
        $student->Identity = request('Identity')->store('uploads', 'public');
        $student->image = request('image')->store('uploads', 'public');
        $student->save();
        dd($student);
    }
}
