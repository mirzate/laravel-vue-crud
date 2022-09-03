<?php

namespace Database\Factories;
use App\Models\Industry;
use App\Models\City;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->name(),
            'industry_id' => Industry::pluck('id')->random(),
            'city_id' => City::pluck('id')->random(),
        ];
    }
}
