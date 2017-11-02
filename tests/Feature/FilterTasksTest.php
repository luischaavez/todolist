<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FilterTasksTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function completed_task_can_be_filtered()
    {
        $completedTasks = factory(Task::class)->times(3)
            ->create(["completed" => true]);

        $incompleteTasks = factory(Task::class)->times(2)
            ->create(["completed" => false]);

        $this->json("GET", "/tasks?completed=true")
            ->assertStatus(200)
            ->assertJson($completedTasks->toArray())
            ->assertJsonMissing($incompleteTasks->toArray());
    }
}
