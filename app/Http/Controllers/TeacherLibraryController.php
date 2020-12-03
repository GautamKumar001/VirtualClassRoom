<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeacherModel;

class TeacherLibraryController extends Controller
{
    public function index()
    {
        return view('TeacherView/datpick');
    }

    public function show()
    {
        return view('TeacherView/TeacherProfile');
    }
    public function ProfileStore(Request $request)
    {
        $data=(request()->validate([
          'Pimage'=>'required|image',

      ]));
        dd($data);
    }
    public function ScheduleStore(Request $request)
    {
        $data=(request()->validate([
          'Schdule'=>'required',
          'DateTime'=>'required',
      ]));
        dd($data);
    }
    public function Bookstore(Request $request)
    {
        $data=(request()->validate([
            'Bname'=>'required',
            'Bimage'=>'required|image',
            'Bpdf'=>'required|mimes:pdf|max:1000000',
        ]));
        dd($data);
    }
    public function Notestore(Request $request)
    {
        $data=(request()->validate(
            [
               'Nname'=>'required',
               'Nimage'=>'required|image',
               'Npdf'=>'required|mimes:pdf|max:1000000'
            ]
        ));
        dd($data);
        //$image = $request->file('Nimage'); //image file from frontend
        //dd($image);
        /*$student      = app('firebase.firestore')->database()->collection('Teacher')->document('defT5uT7SDu9K5RFtIdl');

        $firebase_storage_path = 'Teacher/';

        $name          = $student->id();

        $localfolder = public_path('firebase-temp-uploads') .'/';

        $extension  = $image->getClientOriginalExtension();

        $file            = $name. '.' . $extension;

        if ($image->move($localfolder, $file)) {
            $uploadedfile = fopen($localfolder.$file, 'r');

            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $name]);

            //will remove from local laravel folder
            unlink($localfolder . $file);

            echo 'success';
        } else {
            echo 'error';
        }
        return redirect('/teacherbook');*/
    }
}
