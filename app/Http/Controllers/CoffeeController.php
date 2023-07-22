<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoffeeRequest;
use App\Http\Requests\UpdateCoffeeRequest;
use App\Models\Coffee;

class CoffeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Coffee::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoffeeRequest $request)
    {
        $coffee = Coffee::create($request->validated());
        return $coffee;
    }

    /**
     * Display the specified resource.
     */
    public function show(Coffee $coffee)
    {
        return $coffee;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoffeeRequest $request, Coffee $coffee)
    {
        $coffee->update($request->validated());
        return $coffee;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coffee $coffee)
    {
        //
    }
}
