<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Pusher\Pusher;
use App\User;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $frnd_id = User::where('id', '!=', Auth::id())->get();
        return view('Chat.Agents', ['frnd_id' => $frnd_id]);
    }
    public function contacts()
    {
        $users = DB::select(" select users.id,users.name,users.avatar,users.email,users.status,count(is_read) as unread
        from users LEFT JOIN messages ON users.id= messages.from and is_read=0 and messages.to=" . Auth::id() . "
        where users.id !=" . Auth::id() . "
        group by users.id, users.name, users.avatar, users.email");
        //$users=User::where('id', '!=', Auth::id())->get();
        return view('Chat.Users', ['users' => $users]);
    }


    public function getNames($name)
    {
        //$sortuser = [];
        //$user = DB::table('users')->select('email', 'id')->where('id', '!=', Auth::id())->get();
        //$user = User::where('id', '!=', Auth::id())->get();
        $user = DB::select(" select users.id,users.name,users.avatar,users.email,users.phone,users.profession,count(is_read) as unread
        from users LEFT JOIN messages ON users.id= messages.from and is_read=0 and messages.to=" . Auth::id() . "
        where users.id !=" . Auth::id() . "
        group by users.id, users.name, users.avatar, users.email");
        //echo "<pre>";
        //print_r($user);
        //$myArray = (array) $user;
        $myArray = json_decode(json_encode($user), true);
        //var_dump($myArray);
        //echo "<pre>";
        //print_r(array_values($myArray));
        $srchuser = DB::table('users')->select('email', 'id')->where('name', $name)->get();
        //echo "<pre>";
        //print_r($srchuser);
        //$myArray2 = (array) $srchuser;
        $myArray2 = json_decode(json_encode($srchuser), true);
        //var_dump($myArray2);
        //echo "<pre>";
        //print_r(array_values($myArray2));

        $email = $myArray2[0]["email"];
        $id = $myArray2[0]["id"];
        //echo "<pre>";
        //print_r($email);
        //echo "<pre>";
        ///// print_r($id);

        $email2 = $myArray[4]["email"];
        $id2 = $myArray[4]["id"];
        //echo "<pre>";
        //print_r($email2);
        //echo "<pre>";
        //print_r($id2);
        function find_zindex($array, $search_key)
        {
            foreach ($array as $key => $element) {
                if (array_key_exists('email', $element) && $element['email'] == $search_key) {
                    //echo "Key '$key' has a zindex of ".$element['email']."\n<br>\n";
                    return $key;
                }
            }
            return null;
        }
        function find_zindex2($array, $search_key)
        {
            foreach ($array as $key => $element) {
                if (array_key_exists('id', $element) && $element['id'] == $search_key) {
                    // echo "Key '$key' has a zindex of ".$element['id']."\n<br>\n";
                    return $key;
                }
            }
            return null;
        }

        $key = find_zindex($myArray, $email);
        /*if ($key) {
                  print_r($key);
               }*/
        $key2 = find_zindex2($myArray, $id);

        /* if ($key2) {
             //print_r($key2);
         }*/
        [$myArray[0]["email"], $myArray[$key]["email"]] = [$myArray[$key]["email"], $myArray[0]["email"]];
        [$myArray[0]["id"], $myArray[$key2]["id"]] = [$myArray[$key2]["id"], $myArray[0]["id"]];
        //echo "<pre>";
        //print_r(array_values($myArray));
        //$users = json_encode($myArray,JSON_PRETTY_PRINT);
        $users = json_decode(json_encode($myArray));
        //echo "<pre>";
        //print_r($users);
        return view('Chat.Users', ['users' => $users]);
        //return view('Chat.Users', ['myarray' => $myArray]);
    }
    public function Search()
    {
        return view('Chat.Search');
    }
    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->get();

        return view('Chat.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->reciever_id;
        $message = $request->message;

        //dd($message);


        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
    public function push()
    {
        return view('Message.testpush');
    }
    public function status()
    {
        $id = Auth::id();
        $user = Auth::user();
        $user->status = 'off';
        $user->save();
        $setstatus = 'off';
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['id' => $id, 'status' => $setstatus];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
    public function statusup()
    {
        $id = Auth::id();
        $status = Auth::user()->status;
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['id' => $id, 'status' => $status];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
