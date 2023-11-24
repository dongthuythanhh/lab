<?php

namespace Database\Factories;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = collect([
            Client::STATUS_ACTIVE,
            Client::STATUS_INACTIVE,
        ])->random(1)[0];
        return [
            'company'=>fake()->text(30),
            'img'=>fake()->imageUrl(),
            'name'=>fake()->text(30),
            'projects'=>fake()->randomNumber(3),
            'invoices'=>fake()->randomFloat(0,2,1000),
            'tags'=>fake()->text(100),
            'category'=>fake()->text(30),
            'status' => $status,
        ];
    }
}
