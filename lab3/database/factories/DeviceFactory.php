<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Device;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $is_active = collect([
            Device::ACTIVE,
            Device::INACTIVE,
        ])->random(1)[0];
        
        return [
            'name'=>fake()->text(100),
            'serial'=>fake()->text(50),
            'model'=>fake()->text(50),
            'is_active'=>$is_active,
            'img'=>fake()->imageUrl(),
        ];
    }
}
