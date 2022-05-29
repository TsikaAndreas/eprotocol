<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => 'Administrator',
            'email' => 'admin@admin.com',
            'firstname' => 'Admin',
            'lastname' => 'System',
            'email_verified_at' => now(),
            'password' => Hash::make('Admin123!@#')
        ];
    }
}
