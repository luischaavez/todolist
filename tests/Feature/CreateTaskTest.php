<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_make_a_new_task()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('tasks.store'), [
                'task' => 'Finish my homework'
            ]);

        $this->assertDatabaseHas('tasks', [
            'task'    => 'Finish my homework',
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function guests_may_not_create_new_tasks()
    {
        $this->post(route('tasks.store'))
            ->assertRedirect(route('login'));
    }
}
