<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;

class PostTest extends TestCase
{
    use CreatesApplication, WithFaker;


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testNew()
    {

        $attr = [
            'title' => $this->faker->name,
            'body' => $this->faker->sentence,
        ];

        $post = new Post($attr);

        self::assertEquals($attr, $post->getAttributes());

    }
}
