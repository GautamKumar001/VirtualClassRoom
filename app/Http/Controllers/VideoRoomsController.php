<?php

namespace App\Http\Controllers;

use App\TeacherModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

//require_once '/path/to/vendor/autoload.php';
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use App\Http\Controllers\Exception;
use App\StudentModel;

class VideoRoomsController extends Controller
{
    protected $sid;
    protected $token;
    protected $key;
    protected $secret;
    public function __construct()
    {
        $this->sid = config('services.twilio.sid');
        $this->token = config('services.twilio.token');
        $this->key = config('services.twilio.key');
        $this->secret = config('services.twilio.secret');
    }
    public function TeacherUi()
    {
        $rooms = [];
        try {
            $client = new Client($this->sid, $this->token);
            echo('client created');
            $allRooms = $client->video->rooms->read(["status" => "in-progress"]);
            $rooms = array_map(function ($room) {
                return $room->uniqueName;
            }, $allRooms);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        //dd($rooms);
        return view('VideoScreen.TeacherScreen', ['rooms' => $rooms]);
    }
    public function studentUi()
    {
        $rooms = [];
        try {
            $client = new Client($this->sid, $this->token);
            echo('client created');
            $allRooms = $client->video->rooms->read(["status" => "in-progress"]);
            $rooms = array_map(function ($room) {
                return $room->uniqueName;
            }, $allRooms);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        //dd($rooms);
        return view('VideoScreen.StudentScreen', ['rooms' => $rooms]);
    }
    public function createRoom(Request $request)
    {
        $client = new Client($this->sid, $this->token);

        $exists = $client->video->rooms->read(['uniqueName' => $request->roomName]);

        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $request->roomName,
                'type' => 'group',
                'recordParticipantsOnConnect' => false
            ]);
            echo("created new room: " . $request->roomName);

            \Log::debug("created new room: " . $request->roomName);
        }
        //dd($request->roomName);

        return redirect()->action('VideoRoomsController@joinRoom', [
            'roomName' => $request->roomName
        ]);
    }
    public function joinRoom($roomName)
    {
        // A unique identifier for this user
        $identity = Auth::user()->email;
        $teacheremail=TeacherModel::all()->pluck('email');
        $male=StudentModel::where('gender', 'male')->pluck('email');
        $female=StudentModel::where('gender', 'female')->pluck('email');

        \Log::debug("joined with identity: $identity");
        $token = new AccessToken($this->sid, $this->key, $this->secret, 3600, $identity);

        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName);

        $token->addGrant($videoGrant);

        return view('VideoScreen.Room', ['accessToken' => $token->toJWT(), 'roomName' => $roomName,'teacheremail'=>$teacheremail,'male'=>$male,'female'=>$female]);
    }
    public function roomArch()
    {
        //$male=StudentModel::where('gender', 'male')->pluck('email');
        //$female=StudentModel::where('gender', 'female')->pluck('email');
        //dd($male);
        return view('VideoScreen.Roomarch');
    }
}
