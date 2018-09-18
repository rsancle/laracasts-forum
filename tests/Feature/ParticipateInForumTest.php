<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_unauthenticated_user_may_not_use_replies()
    {
        $thread = factory('App\Thread')->create();
        $this->withExceptionHandling()
            ->post(route('replies.store',['channel' => $thread->channel->id, 'thread' => $thread]), [])
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $user = factory('App\User')->create();
        $this->be($user);

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();
        $this->post($reply->storePath($thread), $reply->toArray());
        $this->get($thread->path())
            ->assertSee($reply->body);

    }

    /** @test */
    function a_reply_requires_body()
    {
        $user = factory('App\User')->create();
        $this->withExceptionHandling()->be($user);

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make(['body'=> null]);

        $this->post($reply->storePath($thread), $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
