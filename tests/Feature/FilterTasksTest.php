<?php

namespace Tests\Feature;

use App\{ Task, User };
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FilterTasksTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function completed_task_can_be_filtered()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $completedTasks = factory(Task::class)->times(3)
            ->create([
                "user_id" => $user->id,
                "completed" => true
            ]);

        $incompleteTasks = factory(Task::class)->times(2)
            ->create([
                "user_id" => $user->id,
                "completed" => false
            ]);

        $this->actingAs($user)
            ->json("GET", "/tasks?completed=true")
            ->assertStatus(200)
            ->assertJson($completedTasks->toArray())
            ->assertJsonMissing($incompleteTasks->toArray());
    }
}
