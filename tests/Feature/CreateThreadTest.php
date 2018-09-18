<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_may_not_create_threads()
    {
        $thread = factory('App\Thread')->make();
        $this->withExceptionHandling()
            ->post(route('threads.store', $thread), [])
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_cannot_see_create_threads()
    {

        $this->withExceptionHandling()
            ->get(route('threads.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_create_threads()
    {
        $this->actingAs(factory('App\User')->create());

        $thread = factory('App\Thread')->make();

        $response = $this->post($thread->storePath(), $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }
    /** @test */
    function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }

    protected function publishThread($overrides = [])
    {
        $this->actingAs(factory('App\User')->create());
        $thread = factory('App\Thread')->make($overrides);
        return $this->post('/threads', $thread->toArray());
    }
}
