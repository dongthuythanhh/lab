<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $is_show = collect([
        //     Brand::ACTIVE,
        //     Brand::INACTIVE,
        // ])->random(1)[0];
        // return [
        //     'name' =>fake()->text(50),
        //     'img' =>fake() ->imageUrl,
        //     'is_show' => $is_show,
        // ];
    }
}
