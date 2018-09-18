<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Channel  $channelSlug
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function store($channelSlug, Thread $thread)
    {
        $this->validate(request(),[
            'body' => 'required'
        ]);
        $thread->addReply([
            'body' => \request('body'),
            'user_id' => auth()->id()
        ]);

        return back();
    }

}
