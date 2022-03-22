<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

class DBUserTest extends TestCase
{

    use CreatesApplication, WithFaker, DatabaseMigrations;

    /**
     * @test
     * @testdox Adding User
     */
    public function test_add_user()
    {
        $attr = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ];

        $user = User::create($attr);
        self::assertDatabaseHas('users', $attr);
    }

    /**
     * @test
     * @testdox Updating User
     */
    public function test_update_user()
    {

        $attr = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ];

        $user = User::create($attr);

        $user->email = $this->faker->email;
        $user->save();
        self::assertDatabaseHas('users', $user->getAttributes());
    }

    /**
     * @test
     * @testdox Showing User
     */
    public function test_show_user()
    {

        $attr = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ];
        $user = User::create($attr);
        $last = User::latest()->first();
        self::assertDatabaseHas('users', $last->getAttributes());
    }

    /**
     * @test
     * @testdox Removing User
     */
    public function test_remove_user()
    {

        $attr = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ];

        $user = User::create($attr);

        $user->delete();
        self::assertSoftDeleted('users', $user->getAttributes());
    }

}
