<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Restaurant;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dishes = match ($request->sort) {
            'price-asc' => Dish::orderBy('price', 'asc')->get(),
            'price-desc' => Dish::orderBy('price', 'desc')->get(),
            default => Dish::all()
        };

        if ($request->restaurant_id) {
            $dishes = Dish::where('restaurant_id', $request->restaurant_id)->get();
        }

        if ($request->search) {
            $dishes = Dish::where('dishes.name', 'like', '%' . $request->search . '%')->get();
        }

        // $dishes = Dish::all();
        $restaurants = Restaurant::all();
        $filter = (int) $request->restaurant_id;

        return view('dish.index', ['dishes' => $dishes, 'restaurants' => $restaurants, 'filter' => $filter, 'search' => $request->search ?? '',]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        return view('dish.create', ['restaurants' => $restaurants]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDishRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dish = new Dish;
        $dish->name = $request->dish_name;
        $dish->price = $request->dish_price;

        // ========================== Photo file ==========================

        if ($request->file('dish_photo')) {

            $photo = $request->file('dish_photo');
            $ext = $photo->getClientOriginalExtension();  //get extention of the file
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME); //original file name

            $file = $name . '-' . rand(100, 111) . '.' . $ext;  //create new name for the file
            $photo->move(public_path() . '/images', $file); //move file from tmp

            $dish->photo = asset('/images') . '/' . $file; //read file path as url
        }

        $dish->restaurant_id = $request->restaurant_id;
        $dish->save();
        return redirect()->route('dish.index')->with('pop_message', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $restaurants = Restaurant::all();
        return view('dish.edit', ['dish' => $dish, 'restaurants' => $restaurants]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDishRequest  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $dish->name = $request->dish_name;
        $dish->price = $request->dish_price;

        // ========================== Photo file ==========================

        if ($request->file('dish_photo')) {

            $name = pathinfo($dish->photo, PATHINFO_FILENAME);
            $ext = pathinfo($dish->photo, PATHINFO_EXTENSION);

            $path = asset('/images') . '/' . $name . '.' . $ext;

            if (file_exists($path)) {
                unlink($path);
            }

            $photo = $request->file('dish_photo');
            $ext = $photo->getClientOriginalExtension();  //get extention of the file
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME); //original file name

            $file = $name . '-' . rand(100, 999) . '.' . $ext;  //create new name for the file
            $photo->move(public_path() . '/images', $file); //move file from tmp

            $dish->photo = asset('/images') . '/' . $file; //read file path as url
        }

        $dish->restaurant_id = $request->restaurant_id;
        $dish->save();
        return redirect()->route('dish.index')->with('pop_message', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {

        if ($dish->photo) {

            $name = pathinfo($dish->photo, PATHINFO_FILENAME);
            $ext = pathinfo($dish->photo, PATHINFO_EXTENSION);

            $path = public_path() . '/images/' . $name . '.' . $ext;

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $dish->delete();
        return redirect()->route('dish.index')->with('pop_message', 'Successfully deleted!');
    }

    public function deletePicture(Dish $dish)
    {
        $name = pathinfo($dish->photo, PATHINFO_FILENAME);
        $ext = pathinfo($dish->photo, PATHINFO_EXTENSION);

        $path = public_path() . '/images/' . $name . '.' . $ext;

        if (file_exists($path)) {
            unlink($path);
        }

        $dish->photo = null;
        $dish->save();

        return redirect()->back()->with('pop_message', 'Dish have no photo now');
    }

    public function rateDish(Request $request)
    {
        $dish = Dish::where('id', $request->dish_id)->first();

        if ($dish->rate <= 0) {
            $dish->rate = $request->dish_rate;
        } else {
            $dish->rate = ($dish->rate + $request->dish_rate) / 2;
        }

        $dish->save();

        return redirect()->route('dish.index')->with('pop_message', 'Successfully rated!');
    }
}
