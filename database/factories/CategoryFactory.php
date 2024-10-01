<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();
        $slug = Str::slug($name);

        $adminUserIds = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->pluck('id');


        return [
            'name' => $name,
            'description' => fake()->unique()->sentence(10),
            'slug' => $slug,
            'user_id' => $adminUserIds->random(),
        ];
    }
}
