<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function showThreadsPath()
    {
        return route('channel.index', ['channel' => $this->slug]);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
