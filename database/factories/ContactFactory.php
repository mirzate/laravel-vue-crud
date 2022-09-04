<?php

namespace Database\Factories;
use App\Models\Customer;
use App\Models\ContactType;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->name(),
            'customer_id' => Customer::pluck('id')->random(),
            'contact_type_id' => ContactType::pluck('id')->random(),
        ];
    }
}
