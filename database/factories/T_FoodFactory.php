<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class T_FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> $this-> faker-> word(),
            'description' =>fake()->word(),
            'unit_price'=> $this->faker->lexify(),
            // 'model' => fake()->asciify('food-****'),
            'promotion_price'=> $this->faker->lexify(),
            'produced_on'=>$this->faker->date(),
            // 'promotion_price'=> $this->faker->randomFloat(),
            'image' => rand(1,3).'.jpg',
        ];
    }
}