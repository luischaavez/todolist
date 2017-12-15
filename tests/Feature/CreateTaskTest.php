<?php

namespace Tests\Feature;

use App\Task;
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

    /** @test */
    function authorized_users_can_delete_tasks()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->json('DELETE', route('tasks.destroy', $task));

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
