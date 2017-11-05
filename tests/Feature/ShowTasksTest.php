<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowTasksTest extends TestCase
{
    use DatabaseTransactions;

    /**  @test */
    public function visit_tasks_page_display_all_the_user_tasks()
    {
        $user = factory(User::class)->create();

        $task = factory(Task::class)->create([
            "user_id" => $user->id
        ]);

        $this->actingAs($user)
            ->get(route("tasks.index"))
            ->assertStatus(200)
            ->assertSee($task->task);
    }
}
