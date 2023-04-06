<?php

namespace Database\Factories;

use App\Models\LoadType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccessCode>
 */
class AccessCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $loadType = LoadType::find($this->faker->numberBetween(1,4));
        $id = $loadType->id;
        $credits = $loadType->load_credits;
        return [
            "load_type_id" => $id,
            'voucher_code' =>  $this->faker->numerify('#####-#####'),
            'duration_mins' => $credits,
            'created_user_id' => 1
        ];
    }
}


