<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WalletTransaction>
 */
class WalletTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "access_provider_id" => 2,
            "wallet_transaction_type_id" => 2,
            "trans_date" => $this->faker->date('Y-m-d H:i:s'),
            "trans_reference" => $this->faker->numerify($this->faker->name.'###'),
            "trans_amount" => $this->faker->randomNumber(5, true),
            "remarks" => $this->faker->numerify($this->faker->name.'###'),
            "user_id" => 5,
            "approval_user_id" => 1

        ];
    }
}
