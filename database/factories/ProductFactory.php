<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = collect(Category::all()->modelKeys());
        return [
            'category_id' => $categories->random(),
            'name' => $this->faker->name(),
            'slug' => Str::slug($this->faker->name()),
            'description' => $this->faker->text,
            'image' => 'placeholder.jpg',
        ];
    }
}
