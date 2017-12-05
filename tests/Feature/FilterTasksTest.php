<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\{ Task, User };
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FilterTasksTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function incomplete_tasks_are_filtered_by_default()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $completedTasks = factory(Task::class)->times(3)
            ->create([
                'user_id' => $user->id,
                'completed' => true
            ]);

        $incompleteTasks = factory(Task::class)->times(2)
            ->create([
                'user_id' => $user->id,
                'completed' => false
            ]);

        $this->actingAs($user)
            ->json('GET', '/tasks')
            ->assertStatus(200)
            ->assertExactJson($incompleteTasks->toArray());
    }

    /** @test */
    public function completed_tasks_can_be_filtered()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $completedTasks = factory(Task::class)->times(3)
            ->create([
                'user_id' => $user->id,
                'completed' => true
            ]);

        $incompleteTasks = factory(Task::class)->times(2)
            ->create([
                'user_id' => $user->id,
                'completed' => false
            ]);

        $this->actingAs($user)
            ->json('GET', '/tasks?completed=1')
            ->assertStatus(200)
            ->assertExactJson($completedTasks->toArray())
            ->assertJsonMissing($incompleteTasks->toArray());
    }

    /** @test */
    public function today_tasks_can_be_filtered()
    {
        $user = factory(User::class)->create();

        $tasksOfToday = factory(Task::class)->times(2)
            ->create(['user_id' => $user->id]);
        
        $tasksOfYesterday = factory(Task::class)->times(2)
            ->create([
                'user_id' => $user->id,
                'created_at' => Carbon::now()->subDay()
            ]);

        $this->actingAs($user)
            ->json('GET', '/tasks?today=1')
            ->assertStatus(200)
            ->assertExactJson($tasksOfToday->toArray())
            ->assertJsonMissing($tasksOfYesterday->toArray());
    }

    /** @test */
    public function week_tasks_can_be_filtered()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        
        $tasksOfLastWeek = factory(Task::class)->times(2)
            ->create([
                'user_id' => $user->id,
                'created_at' => Carbon::now()->subWeek()
            ]);

        $weekTasks = factory(Task::class)->times(2)
            ->create([
                'user_id' => $user->id
            ]);

        $this->actingAs($user)
            ->json('GET', '/tasks?week=1')
            ->assertStatus(200)
            ->assertExactJson($weekTasks->toArray())
            ->assertJsonMissing($tasksOfLastWeek->toArray());
    }
}
