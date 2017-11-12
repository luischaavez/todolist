<?php

namespace Tests\Feature;

use App\User;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompleteTaskTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function a_user_can_mark_as_complete_one_task()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)
            ->create(["user_id" => $user->id]);

        $this->assertFalse($task->completed);

        $this->json("PATCH", route("tasks.complete.store", $task));    

        $this->assertTrue($task->fresh()->completed);
    }

    /** @test */
    function a_user_can_mark_as_incomplete_a_completed_task()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create([
            "user_id" => $user->id,
            "completed" => true
        ]);

        $this->assertTrue($task->completed);

        $this->json("PATCH", route("tasks.complete.destroy", $task));    

        $this->assertFalse($task->fresh()->completed);
    }
}
