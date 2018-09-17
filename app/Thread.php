<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public static function rules(){
       return [
            'title' => 'required | string'
        ];
    }

    public static function validate($request)
    {
        $request->validate(self::rules());
    }

    public function path()
    {
        return route('threads.show', ['channel' => $this->channel->slug, 'thread' => $this]);
    }

    public static function store($thread)
    {
        return route('threads.store', $thread);
    }

    public function storePath()
    {
        return self::store($this);
    }



    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
