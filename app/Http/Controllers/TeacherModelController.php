<?php

namespace App\Http\Controllers;

use App\TeacherModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

//use Image;

class TeacherModelController extends Controller
{
    public function index()
    {
        $authemail=Auth::user()->email;
        $authname=Auth::user()->name;
        return view('TeacherView.TeacherForm', compact('authname', 'authemail'));
    }
    public function show()
    {
        return view('TeacherView.TeacherProfile');
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

        $teacher = new TeacherModel();
        $teacher->name = request('Name');
        $teacher->email = request('email');
        $teacher->gender = request('gender');
        $teacher->age = request('age');
        $teacher->institute = request('institute');
        $teacher->Identity = request('Identity')->store('uploads', 'public');
        $teacher->image = request('image')->store('uploads', 'public');
        $teacher->save();
        return redirect()->route('TeacherView');
    }

    public function upload(Request $request)
    {
        if ($request->get('image')) {
            $image = $request->get('image');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/') . $name);
        }
        if ($request->get('Identity')) {
            $image = $request->get('image');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/') . $name);
        }
        if ($request->hasFile('image')) {
            $uniqueid = uniqid();
            $original_name = $request->file('image')->getClientOriginalName();
            $size = $request->file('image')->getSize();
            $extension = $request->file('image')->getClientOriginalExtension();

            $name = $uniqueid . '.' . $extension;
            $path = $request->file('image')->storeAs('public/uploads', $name);
            if ($path) {
                return response()->json(array('status' => 'success', 'message' => 'Image successfully uploaded', 'image' => '/storage/uploads/' . $name));
            } else {
                return response()->json(array('status' => 'error', 'message' => 'failed to upload image'));
            }
        }
    }
    public function insert(Request $request)
    {
        $name = $request->nome;
        $image = $request->file;
        /*remove special characters and spaces*/
        $name = preg_replace("/[^A-Za-z0-9]/", "", $name);
        $nowTIME = Carbon::now();
        if ($name ==null) {
            return response()->json("Error!");
        } else {
            $material_array = [];
            $namefile = '_' . time() . '.png';
            $destinationPath = public_path('product_images') . '/' . $namefile;
            if (file_put_contents($destinationPath, file_get_contents($image))) {
                // echo 'Uploaded file';
            } else {
                echo "Unable to save the file.";
            }
        }
    }
    public function nav()
    {
        return view('Navbar');
    }
}
