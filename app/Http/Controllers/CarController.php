<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // todo : we came back to this after add auth
        $cars = User::find(6)
        ->cars()
        ->with(['primaryImage', 'model', 'maker'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {

        return view('car.show',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('car.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
    public function search()
    {
        $query = Car::where("published_at", '<', now())
                ->with(['primaryImage','city', "maker", 'model', 'carType', 'fuelType'])
                ->orderBy('published_at', 'desc');

        // $query->join('cities', 'cars.city_id', '=', 'cities.id')
        // ->where('cities.state_id', '=', 1);
        // $query->select('cars.*', 'cities.name as city_name');
        // $carCount = $query->count();
        // $cars = $query->limit(30)->get();
        $cars = $query->paginate(5);
        return view('car.search', compact('cars'));
    }
    public function watchList(){
        // todo : we came back to this after add auth
        $cars = User::find(4)
        ->favouriteCars()
        ->with(['primaryImage','city', "maker", 'model', 'carType', 'fuelType'])
        ->get();
        return view('car.watchList',compact('cars'));
    }
}
