<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IdentitycardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory()->create()->id,
            'identity_number' => $this->faker->numerify('########'),
            'phone_number' => $this->faker->phoneNumber()
        ];
    }
}
