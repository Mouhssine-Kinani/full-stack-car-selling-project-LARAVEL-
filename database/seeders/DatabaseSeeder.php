<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // car type
        CarType::factory()
        ->sequence(
            ['name' => 'SUV'],
            ['name' => 'Sedan'],
            ['name' => 'Hatchback'],
            ['name' => 'Truck'],
            ['name' => 'Coupe'],
            ['name' => 'Convertible'],
            ['name' => 'Van'],
            ['name' => 'Wagon'],
            ['name' => 'Crossover'],
            ['name' => 'Sports Car'],
            ['name' => 'Luxury Car'],
            ['name' => 'Electric Car'],
            ['name' => 'Hybrid Car'],
            ['name' => 'Diesel Car'],
            ['name' => 'Compact Car'],
        )
        ->count(15)
        ->create();

        // fuel type
        FuelType::factory()
        ->sequence(
            ['name' => 'Petrol'],
            ['name' => 'Diesel'],
            ['name' => 'Electric'],
            ['name' => 'Hybrid'],
            ['name' => 'CNG'],
            ['name' => 'LPG'],
            ['name' => 'Ethanol'],
            ['name' => 'Biodiesel'],
            ['name' => 'Hydrogen'],
        )
        ->count(8)
        ->create();

        // states
        $states = [
            'Califonia'=> [
                'Los Angeles',
                'San Francisco',
                'San Diego',
                'Sacramento',
                'San Jose',
            ],
            'Texas'=> [
                'Houston',
                'Dallas',
                'Austin',
                'San Antonio',
                'Fort Worth',
            ],
            'Florida'=> [
                'Miami',
                'Orlando',
                'Tampa',
                'Jacksonville',
                'Tallahassee',
            ],
            'New York'=> [
                'New York City',
                'Buffalo',
                'Rochester',
                'Albany',
                'Syracuse',
            ],
            'Illinois'=> [
                'Chicago',
                'Springfield',
                'Peoria',
                'Naperville',
                'Rockford',
            ],
            'Pennsylvania'=> [
                'Philadelphia',
                'Pittsburgh',
                'Harrisburg',
                'Allentown',
                'Erie',
            ],
            'Ohio'=> [
                'Columbus',
                'Cleveland',
                'Cincinnati',
                'Toledo',
                'Akron',
            ],
            'Georgia'=> [
                'Atlanta',
                'Savannah',
                'Augusta',
                'Macon',
                'Columbus',
            ],
            'North Carolina'=> [
                'Charlotte',
                'Raleigh',
                'Greensboro',
                'Durham',
                'Winston-Salem',
            ],
            'Michigan'=> [
                'Detroit',
                'Grand Rapids',
                'Ann Arbor',
                'Lansing',
                'Flint',
            ],
            'New Jersey'=> [
                'Newark',
                'Jersey City',
                'Paterson',
                'Elizabeth',
                'Edison',
            ],
            'Virginia'=> [
                'Virginia Beach',
                'Norfolk',
                'Chesapeake',
                'Richmond',
                'Newport News',
            ],
            'Washington'=> [
                'Seattle',
                'Spokane',
                'Tacoma',
                'Vancouver',
                'Bellevue',
            ],
            'Arizona'=> [
                'Phoenix',
                'Tucson',
                'Mesa',
                'Chandler',
                'Scottsdale',
            ],
            'Massachusetts'=> [
                'Boston',
                'Worcester',
                'Springfield',
                'Cambridge',
                'Lowell',
            ],
            'Tennessee'=> [
                'Nashville',
                'Memphis',
                'Knoxville',
                'Chattanooga',
                'Clarksville',
            ],
        ];

        foreach ($states as $state => $cities){
            State::factory()
            ->state(['name'=>$state])
            ->has(
                City::factory()
                ->count(count($cities))
                ->sequence(...array_map(fn($city)=> ['name'=>$city] , $cities))
            )
            ->create();
        }

        // makers
        $makers = [
            'Toyota' => [
                'Camry',
                'Corolla',
                'RAV4',
                'Highlander',
                'Tacoma',
            ],
            'Honda' => [
                'Civic',
                'Accord',
                'CR-V',
                'Pilot',
                'Fit',
            ],
            'Ford' => [
                'F-150',
                'Mustang',
                'Explorer',
                'Escape',
                'Focus',
            ],
            'Chevrolet' => [
                'Silverado',
                'Malibu',
                'Equinox',
                'Traverse',
                'Camaro',
            ],
            'Nissan' => [
                'Altima',
                'Sentra',
                'Rogue',
                'Murano',
                'Pathfinder',
            ],
            'Hyundai' => [
                'Elantra',
                'Sonata',
                'Tucson',
                'Santa Fe',
                'Kona',
            ],
            'Kia' => [
                'Optima',
                'Sorento',
                'Sportage',
                'Forte',
                'Soul',
            ],
            'Volkswagen' => [
                'Jetta',
                'Passat',
                'Tiguan',
                'Atlas',
                'Golf',
            ],
            'Subaru' => [
                'Outback',
                'Forester',
                'Crosstrek',
                'Legacy',
                'Impreza',
            ],
        ];

        foreach( $makers as $maker => $models){
            Maker::factory()
            ->state(['name'=>$maker])
            ->has(
                Model::factory()
                ->count(count($models))
                ->sequence(...array_map(fn($model)=> ['name'=>$model],$models))
            )
            ->create();
        }

        //users , cars with images and features
        User::factory()->count(3)->create();

        User::factory()
        ->count(2)
        ->has(
            Car::factory()
            ->count(50)
            ->has(
                CarImage::factory()
                ->count(5)
                ->sequence(fn(Sequence $sequence) => ['position' => $sequence->index + 1]),
                'images'
            )
            ->hasFeatures(),
            'favouriteCars'
        )
        ->create();
    }
}
