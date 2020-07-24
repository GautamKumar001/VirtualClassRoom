<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

//require_once '/path/to/vendor/autoload.php';
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use App\Http\Controllers\Exception;

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
    public function clientUi()
    {
        $rooms = [];
        try {
            $client = new Client($this->sid, $this->token);
            echo('client created');
            $allRooms = $client->video->rooms->read([]);

            $rooms = array_map(function ($room) {
                return $room->uniqueName;
            }, $allRooms);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        //dd($allRooms);
        return view('VideoScreen.videoScreen', ['rooms' => $rooms]);
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
        $identity = Auth::user()->name;

        \Log::debug("joined with identity: $identity");
        $token = new AccessToken($this->sid, $this->key, $this->secret, 3600, $identity);

        $videoGrant = new VideoGrant();
        $videoGrant->setRoom($roomName);

        $token->addGrant($videoGrant);

        return view('VideoScreen.Room', [ 'accessToken' => $token->toJWT(), 'roomName' => $roomName ]);
    }
}
