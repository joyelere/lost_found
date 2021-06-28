<?php

namespace App\Http\Controllers;

use App\Lib\PusherFactory;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function messages(){
        $messages = Message::where("to_user","=",Auth::user()->id)->orWhere("from_user","=",Auth::user()->id)->select('from_user','to_user','created_at','content')->get()->reverse();
     return view('inbox',compact('messages'));
    }


    /**
     * getLoadLatestMessages
     *
     *
     * @param Request $request
     */
    public function getLoadLatestMessages(Request $request)
    {
        if(!$request->user_id) {
            return;
        }

        $messages = Message::where(function($query) use ($request) {
            $query->where('from_user', Auth::user()->id)->where('to_user', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id);
        })->orderBy('created_at', 'DESC')->limit(10)->get();

        $return = [];

        foreach ($messages as $message) {

            $return[] = view('message-line')->with('message', $message)->render();
        }
        $return = array_reverse($return);

        return response()->json(['state' => 1, 'messages' => $return]);
    }


    /**
     * postSendMessage
     *
     * @param Request $request
     */
    public function postSendMessage(Request $request)
    {
        if(!$request->to_user || !$request->message) {
            return;
        }

        $message = new Message();

        $message->from_user = Auth::user()->id;

        $message->to_user = $request->to_user;

        $message->content = $request->message;

        $message->save();


        // prepare some data to send with the response
        $message->dateTimeStr = date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString()));

        $message->dateHumanReadable = $message->created_at->diffForHumans();

        $message->fromUserName = $message->fromUser->name;

        $message->from_user_id = Auth::user()->id;

        $message->toUserName = $message->toUser->name;

        $message->to_user_id = $request->to_user;

        PusherFactory::make()->trigger('chat', 'send', ['data' => $message]);

        return response()->json(['state' => 1, 'data' => $message]);
    }


    /**
     * getOldMessages
     *
     * we will fetch the old messages using the last sent id from the request
     * by querying the created at date
     *
     * @param Request $request
     */
    public function getOldMessages(Request $request)
    {
        if(!$request->old_message_id || !$request->to_user)
            return;

        $message = Message::find($request->old_message_id);

        $lastMessages = Message::where(function($query) use ($request, $message) {
            $query->where('from_user', Auth::user()->id)
                ->where('to_user', $request->to_user)
                ->where('created_at', '<', $message->created_at);
        })
            ->orWhere(function ($query) use ($request, $message) {
            $query->where('from_user', $request->to_user)
                ->where('to_user', Auth::user()->id)
                ->where('created_at', '<', $message->created_at);
        })
            ->orderBy('created_at', 'ASC')->limit(10)->get();

        $return = [];

        if($lastMessages->count() > 0) {

            foreach ($lastMessages as $message) {

                $return[] = view('message-line')->with('message', $message)->render();
            }

            PusherFactory::make()->trigger('chat', 'oldMsgs', ['to_user' => $request->to_user, 'data' => $return]);
        }

        return response()->json(['state' => 1, 'data' => $return]);
    }
}
