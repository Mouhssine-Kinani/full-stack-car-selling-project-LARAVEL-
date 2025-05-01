<?php

namespace App\Http\Controllers;

use Attribute;
use App\Models\Car;
use App\Models\Maker;
use App\Models\CarType;
use App\Models\CarImage;
use App\Models\FuelType;
use App\Models\CarFeatures;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $maker = Maker::factory()->count(3)->create();
        // dd($maker);

        // $users = User::factory()->count(3)->make([
        //     "name" => 'simo'
        // ]);
        $users = User::factory()
        ->count(4)
        ->sequence(fn($sequence)=>['name'=>'userName'.$sequence->index])
        ->create();
        dd($users);

        return view('home.index');
    }
}

// //select all cars
// $cars = Car::get();
// dump($cars) ;
// //select published cars
// $cars = Car::where('id','2')->get();
// dump($cars) ;
// //order by
// $cars = Car::orderBy('id','desc')->get();
// dump($cars);
//----------enregistre dans db-----------------------
// $car = new Car();
// $car->maker_id = 1;
// $car->model_id = 2;
// $car->year = 2003;
// $car->price = 20000;
// $car->vin = 12121212345555;
// $car->mileage = 300000;
// $car->car_type_id = 1;
// $car->fuel_type_id = 2;
// $car->user_id = 1;
// $car->city_id = 2;
// $car->phone = '849399299';
// $car->address = "mocaijweojfww";
// $car->description = null;
// $car->published_at = now();
// $car->created_at = now();
// $car->updated_at = null;
// $car->deleted_at = null;
// $car->save();
//-------------------------
// $carData = [
//     'maker_id' => 1,
//     'model_id' => 1,
//     'year' => 1,
//     'price' => 1,
//     'vin' => 1,
//     'mileage' => 1,
//     'car_type_id' => 1,
//     'fuel_type_id' => 1,
//     'user_id' => 1,
//     'city_id' => 1,
//     'phone' => 1,
//     'address' => 1,
//     'description' => '1',
//     'published_at' => now(),
//     // 'created_at' => 1,
//     // 'updated_at' => 1,
//     // 'deleted_at' => 1
// ];
//aproche 1
// $car = Car::create($carData);
//aproche 2
// $car2 = new Car();
// $car2->fill($carData);
// $car2->save();
// //approche 3
// $car3 = new Car($carData);
// $car3->save();
//update car
// $car = Car::find(1);
// $car->price = 30000;
// $car->save();
// upadate or create
// Car::updateOrCreate([
//     'vin'=>'12121', 'price'=>'30000'
// ],[
//     'price'=>'43600'
// ]);
// //mass updates
// Car::where('published_at',null)
// ->where('user_id',1)
// ->update(["published_at"=>now()]);
// //delete
// $car = Car::find(1);
// $car->delete();
// Car::truncate();


// //access car features and imges
// $car = Car::find(1);
// dump($car->features,$car->primaryImage);
// //update
// // $car->features->abs = 0;
// // $car->features->save();
// //or
// $car->features->update(['abs'=>1]);

// //delete
// $car->primaryImage->delete();

// $car = Car::find(2);
// $carFeatures = new CarFeatures([
//     'abs'=>false,
//     'air_conditioning'=> true,
//     'power_windows'=> false,
//     'power_door_locks'=> true,
//     'cruise_control'=> true,
//     'bluetooth_connectivity'=> true,
//     'remote_start'=> true,
//     'gps_navigation'=> true,
//     'heated_seats'=> true,
//     'climate_control'=> true,
//     'rear_parking_sensors'=> true,
//     'leather_seats'=> false,
// ]);

// $car->features()->save($carFeatures);

// $car1 = Car::where("price", ">", 7000)->get();
// $maker1 = Maker::where('name','toyota')->get();
// $newFuelType = FuelType::create([ "name"=> "netrogen"]);
// $car1updatePrice = Car::where('id', 1)->update(['price'=>15000]);
// one to one



// $car = Car::find(1);

// if ($car->features) {
//     dd($car->features->abs);  // Should output: true or 1
// } else {
//     dd('No features found for this car.');
// }
// one to many
// $car = Car::find(1);
// dd($car->images);
// $image = new CarImage(['image_path' => 'path/to/image.jpg','position' => 3,]);
// $car->images()->save($image);
// $car->images()->create(['image_path' => 'path/to/image.jpg','position' => 4,]);

// $car->images()->saveMany([
//     new CarImage(['image_path' => 'path/to/image.jpg','position' => 5,]),
//     new CarImage(['image_path' => 'path/to/image.jpg','position' => 6,]),
// ]);
// $car->images()->createMany([
//     ['image_path' => 'path/to/image.jpg','position' => 7,],
//     ['image_path' => 'path/to/image.jpg','position' => 8,],
// ]);
// many to one
// $car = Car::find(1);
// // dump($car->carType);

// $carType = CarType::where('name','4x4')->first();
// // $cars = Car::whereBelongsTo($carType)->get();
// // dump($cars);
// // short way : because we defined the relations in both ways :
// $cars1 = $carType->cars;
// dd($cars1);
// many to many
// $car = Car::find(1);
// dd($car->favouredUsers);

// $user = User::find(1);
// // dd($user->favouriteCars);
// $user->favouriteCars()->attach([1]); // add to favourite car for a user
