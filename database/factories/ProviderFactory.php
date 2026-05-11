<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [

            'name' => $name,

            'slug' => Str::slug(
                $name . '-' . fake()->unique()->numberBetween(100, 999)
            ),

            'bio' => fake()->paragraph(),

            'avatar' => fake()->imageUrl(),

            'location' => fake()->city(),

            'category' => fake()->randomElement([
                'Desain',
                'Programming',
                'Les Privat',
                'Fotografi',
                'Marketing',
                'Video Editing',
            ]),

            'type' => fake()->randomElement([
                'online',
                'offline',
            ]),

            'experience' => fake()->sentence(),

            'portfolio' => fake()->url(),

            'base_price' => fake()->numberBetween(
                50000,
                500000
            ),

            'verification_status' => fake()->randomElement([
                'verified',
                'verified',
                'verified',
                'pending',
            ]),

            'is_active' => true,
        ];
    }
}
