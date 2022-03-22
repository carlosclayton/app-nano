<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrudPostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * @testdox test post screen can be rendered
     */
    public function test_post_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/posts');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @testdox test create new post
     */
    public function test_create_new_post()
    {
        $attr = [
            'title' => $this->faker->title,
            'body' => $this->faker->sentence
        ];

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts', $attr);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

    }

    /**
     * @test
     * @testdox test create new post without title
     */
    public function test_create_new_post_without_title()
    {
        $attr = [
            'title' => '',
            'body' => $this->faker->sentence
        ];

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts', $attr);
        $response->assertRedirect();
        $response->assertSessionHasErrors([
            'title' => 'The title field is required.'
        ]);

    }

}
