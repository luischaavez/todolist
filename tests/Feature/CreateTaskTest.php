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
        $this->signIn()
            ->post(route('tasks.store'), [
                'body' => 'Finish my homework'
            ]);

        $this->assertDatabaseHas('tasks', [
            'body'    => 'Finish my homework',
            'user_id' => auth()->id()
        ]);
    }

    /** @test */
    function users_can_create_tasks_in_a_given_project()
    {
        $this->signIn();

        $project = factory(Project::class)->create([
            'user_id' => auth()->id()
        ]);

        $this->post(route('tasks.store'), [
               'body'    => 'Finish project',
               'project' => $project->id
            ]);

        $this->assertDatabaseHas('tasks', [
           'body'       => 'Finish project',
           'project_id' =>  $project->id,
           'user_id'    => auth()->id()
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
        $this->signIn();
        
        $task = factory(Task::class)->create([
            'user_id' => auth()->id()
        ]);

        $this->json('DELETE', route('tasks.destroy', $task))
            ->assertStatus(200);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
