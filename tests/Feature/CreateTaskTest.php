<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTaskTest extends TestCase
{
    use DatabaseTransactions;
    /** @test */
    public function an_authenticated_user_can_make_a_new_task()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route("tasks.store"), [
                "task" => "Finish my homework"
            ]);

        $this->assertDatabaseHas("tasks", [
            "task"    => "Finish my homework",
            "user_id" => $user->id
        ]);
    }
}
