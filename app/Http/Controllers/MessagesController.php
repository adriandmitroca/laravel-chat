<?php

namespace App\Http\Controllers;

use App\Events\MessageWasSent;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests;

class MessagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::latest()->limit(10)->get();

        return view('chat', compact('messages'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMessageRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        $message          = new Message;
        $message->content = $request->get('content');
        $message->author  = $request->get('author');
        $message->save();

        session()->put('nickname', $request->get('author'));

        event(new MessageWasSent($message));
    }
}
