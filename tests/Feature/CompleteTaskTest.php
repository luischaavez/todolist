<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{ Task, User };
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompleteTaskTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function a_user_can_mark_as_complete_one_task()
    {
        $this->signIn();
        
        $task = factory(Task::class)
            ->create(['user_id' => auth()->id()]);

        $this->assertFalse($task->completed);

        $this->json('PATCH', route('tasks.complete.store', $task));

        $this->assertTrue($task->fresh()->completed);
    }

    /** @test */
    function a_user_can_mark_as_incomplete_a_completed_task()
    {
        $this->signIn();

        $task = factory(Task::class)->create([
            'user_id' => auth()->id(),
            'completed' => true
        ]);

        $this->assertTrue($task->completed);

        $this->json('PATCH', route('tasks.complete.destroy', $task));

        $this->assertFalse($task->fresh()->completed);
    }
}
