<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    public function storePath($thread){
        return route('replies.store',['channel' => $thread->channel->slug, 'thread' => $thread]);
    }


    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread() {
        return $this->belongsTo(Thread::class);
    }

}
