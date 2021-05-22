<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vendor;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'contact_person' => $this->faker->name(),
            'contact_person_telno' => $this->faker->tollFreePhoneNumber(),
            'contact_person_email' => $this->faker->email(),
        ];
    }
}
