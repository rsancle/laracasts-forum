<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $channelSlug
     * @return \Illuminate\Http\Response
     */
    public function index($channelSlug = null)
    {

        if($channelSlug){
            $threads = Channel::where('slug', $channelSlug)->first()->threads()->latest()->get();
        }else{
            $threads = Thread::latest()->get();
        }

        return view('threads.index', compact('threads'));
    }
}
