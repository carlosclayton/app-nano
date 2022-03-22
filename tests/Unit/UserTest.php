<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;

class UserTest extends TestCase
{
    use CreatesApplication, WithFaker, DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testNew()
    {


        $attr = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];

        $user = new User($attr);

        self::assertEquals($attr, $user->getAttributes());

    }
}
