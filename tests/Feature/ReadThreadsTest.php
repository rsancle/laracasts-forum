<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    private $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function an_user_can_browse_threads()
    {
        $this->get(route('threads.index'))
            ->assertStatus(200)
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function an_user_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function an_user_read_associated_replies_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body);

    }
    
    /** @test */
    public function an_user_can_filter_threads_by_channel()
    {
        $channel = factory('App\Channel')->create();
        $threadChannel = factory('App\Thread')->create(['channel_id' => $channel->id]);
        $threadNotInChannel = factory('App\Thread')->create();
        $this->get($channel->showThreadsPath())
            ->assertSee($threadChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    
    }

}
