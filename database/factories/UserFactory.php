<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class UserFactory
 *
 * This factory allows the creation of fake instances of the `User` model
 * for testing and database seeding.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Default password used in the factory.
     *
     * It remains static to prevent multiple encryptions during user generation
     * in tests.
     *
     * @var string|null
     */
    protected static ?string $password = null;

    /**
     * Defines the default state of the `User` model.
     *
     * Generates fake values for the attributes, including:
     * - Random name
     * - Unique and secure email
     * - Current email verification timestamp
     * - Encrypted password
     * - "Remember me" token
     *
     * @return array<string, mixed> Generated user data.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Generates a random name
            'email' => fake()->unique()->safeEmail(), // Generates a unique email
            'email_verified_at' => now(), // Marks the email as verified
            'password' => static::$password ??= Hash::make('password'), // Encrypted password
            'remember_token' => Str::random(10), // Random token
        ];
    }

    /**
     * Indicates that the user's email is not verified.
     *
     * This function is used in tests where an unverified user is required.
     *
     * @return static Returns an instance with the modified state.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
