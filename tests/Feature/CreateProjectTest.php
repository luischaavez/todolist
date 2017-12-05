<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{ Project, User };
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
        public function a_user_can_create_a_new_project()
    {
        $user = factory(User::class)->create();

        $project = factory(Project::class)->make([
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->post(route('projects.store'), $project->toArray());

        $this->assertDatabaseHas('projects', [
           'name'    => $project->name,
           'user_id' => $user->id
        ]);
    }
}
