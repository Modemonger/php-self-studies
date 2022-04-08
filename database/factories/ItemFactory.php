<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Item::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->title,
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL),
            'clear' => $this->faker->boolean(),
            'cloudy' => $this->faker->boolean(),
            'rain' => $this->faker->boolean(),
            'created_at' => now(),
        ];
    }
}
