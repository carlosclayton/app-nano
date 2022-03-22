<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

class DBPostTest extends TestCase
{

    use CreatesApplication, WithFaker, DatabaseMigrations;



    /**
     * @test
     * @testdox Adding Post
     */
    public function test_add_post()
    {
        $attr = [
            'title' => $this->faker->title,
            'body' => $this->faker->sentence
        ];

        $post = Post::create($attr);
        self::assertDatabaseHas('posts', $attr);
    }

    /**
     * @test
     * @testdox Updating Post
     */
    public function test_update_post()
    {

        $attr = [
            'title' => $this->faker->title,
            'body' => $this->faker->sentence
        ];

        $post = Post::create($attr);

        $post->body = $this->faker->sentence;
        $post->save();
        self::assertDatabaseHas('posts', $post->getAttributes());
    }

    /**
     * @test
     * @testdox Showing Post
     */
    public function test_show_post()
    {

        $attr = [
            'title' => $this->faker->title,
            'body' => $this->faker->sentence
        ];
        $post = Post::create($attr);
        $last = Post::latest()->first();
        self::assertDatabaseHas('posts', $last->getAttributes());
    }

    /**
     * @test
     * @testdox Removing Post
     */
    public function test_remove_post()
    {

        $attr = [
            'title' => $this->faker->title,
            'body' => $this->faker->sentence
        ];

        $post = Post::create($attr);

        $post->delete();
        self::assertSoftDeleted('posts', $post->getAttributes());
    }

}
