<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(40),
            'description' => $this->faker->text(100),
            'category_id' => Category::all()->random()->id,
            'start_price' => $this->faker->numberBetween(0, 200),
            'user_id' => User::all()->random()->id,
            'status' => $this->faker->randomElement(['draft', 'sale', 'sold']),
        ];
    }
}
