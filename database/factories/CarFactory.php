<?php

namespace Database\Factories;

use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ensure required models exist
        $maker = Maker::inRandomOrder()->first() ?? Maker::factory()->create();
        $carType = CarType::inRandomOrder()->first() ?? CarType::factory()->create();
        $fuelType = FuelType::inRandomOrder()->first() ?? FuelType::factory()->create();
        $city = City::inRandomOrder()->first() ?? City::factory()->create();
        
        return [
            'maker_id' => $maker->id,
            'model_id' => function ($attributes) use ($maker) {
                $model = Model::where('maker_id', $maker->id)->inRandomOrder()->first() ?? 
                         Model::factory()->create(['maker_id' => $maker->id]);
                return $model->id;
            },
            'year' => fake()->year(),
            "price" => ((int)fake()->randomFloat(2, 5, 100)) * 1000,
            "vin" => strtoupper(Str::random(17)),
            "mileage" => ((int)fake()->randomFloat(2, 5, 500)) * 1000,
            'car_type_id' => $carType->id,
            'fuel_type_id' => $fuelType->id,
            // Default to a random user if not specified
            'user_id' => function() {
                return User::inRandomOrder()->first()?->id ?? User::factory()->create()->id;
            },
            'city_id' => $city->id,
            'address' => fake()->address(),
            'phone' => function (array $attributes) {
                // Check if user_id exists before trying to access it
                if (isset($attributes['user_id']) && $attributes['user_id']) {
                    $user = User::find($attributes['user_id']);
                    return $user ? $user->phone : fake()->numerify("##########");
                }
                return fake()->numerify("##########");
            },
            'description' => fake()->text(400),
            "published_at" => fake()->optional(0.83)->dateTimeBetween('-1 month', "+1 day")
        ];
    }
    
    /**
     * Configure the model factory for use in favourite cars relationship.
     * This method doesn't need to modify anything since the default factory
     * definition will create a valid user if needed.
     *
     * @return static
     */
    public function forFavourites(): static
    {
        return $this;
    }
}
