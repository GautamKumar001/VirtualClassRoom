<?php

namespace App\Http\Controllers\Firebase;

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Image;
use \Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Storage;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Query;
use function GuzzleHttp\json_decode;

class FirebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceAccount = ServiceAccount::fromValue(__DIR__ . '/firebase.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $database = $firebase->getDatabase();
        $currentuser=Auth::user()->email;
        $user=[$currentuser=>'on'];
        $php_string = json_encode($user, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $newPost = $database
            ->getReference('status')
            ->push($php_string);
        echo '<pre>';
        print_r($newPost->getvalue());
        $reference = $database->getReference('status');
        print_r($reference->getchild("mailme@gmail.com")->getvalue());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=(request()->validate(
            ['image'=>'required|image'  ]
        ));
        $image = $request->file('image'); //image file from frontend

        $student      = app('firebase.firestore')->database()->collection('Student')->document('defT5uT7SDu9K5RFtIdl');

        $firebase_storage_path = 'Students/';

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
        return redirect('/fireshow');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('fileupload');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
