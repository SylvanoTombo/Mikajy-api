<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class Authentication extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_register()
    {

        //Create
        $password = Hash::make('password');

        $user = [
            'name' => fake()->name,
            'pseudo' => fake()->firstName(),
            'phone_number' => Str::random(10),
            'password' => $password,
            'password_confirmation' => $password
        ];

        //Action
        $response = $this->post('/api/register', $user);

        //Assertion
        $response->assertStatus(201);
    }

    public function test_user_can_login()
    {
        $user = User::first()->only(['pseudo', 'password']);

        $response = $this->post('/api/login', $user);

        $response->assertStatus(200);
    }
}
