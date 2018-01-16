<?php

namespace Tests\Feature;

use App\Project;
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
    function users_can_create_tasks_in_a_given_project()
    {
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create([
            "user_id" => $user->id
        ]);

        $this->actingAs($user)
            ->post(route('tasks.store'), [
               'task'    => 'Finish project',
               'project' => $project->id
            ]);

        $this->assertDatabaseHas('tasks', [
           'task'       => 'Finish project',
           'project_id' =>  $project->id,
           'user_id'    => $user->id
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
