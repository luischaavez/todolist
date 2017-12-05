<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{ Task, User };
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowTasksTest extends TestCase
{
    use DatabaseTransactions;

    /**  @test */
    public function visit_tasks_page_display_all_the_user_tasks()
    {
        $user = factory(User::class)->create();

        $tasks = factory(Task::class)->times(2)
            ->create([
                'user_id' => $user->id
            ]);

        $this->actingAs($user)
            ->json('GET', route('tasks.index'))
            ->assertStatus(200)
            ->assertJson($tasks->toArray());
    }
}
