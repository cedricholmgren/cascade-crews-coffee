<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoffeeRequest;
use App\Http\Requests\UpdateCoffeeRequest;
use App\Models\Coffee;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class CoffeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Coffees/Index', [
            'filters' => Request::all('search', 'trashed'),
            'coffees' => Coffee::orderBy('id', 'desc')
                ->filter(Request::only('search', 'trashed'))
                ->paginate()
                ->withQueryString()
                ->through(function ($coffee) {
                    return [
                        'id' => $coffee->id,
                        'order_id' => $coffee->order_id,
                        'user_id' => $coffee->user_id,
                        'size' => $coffee->size,
                        'name' => $coffee->name,
                        'note' => $coffee->note,
                        'created_at' => $coffee->created_at,
                        'deleted_at' => $coffee->deleted_at,
                    ];
                }),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoffeeRequest $request)
    {
        Coffee::create($request->validated());
        return Redirect::route('coffees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coffee $coffee)
    {
        return Inertia::render('Coffees/Show', [
            'coffee' => [
                'id' => $coffee->id,
                'order_id' => $coffee->order_id,
                'user_id' => $coffee->user_id,
                'size' => $coffee->size,
                'name' => $coffee->name,
                'note' => $coffee->note,
                'created_at' => $coffee->created_at,
                'deleted_at' => $coffee->deleted_at,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoffeeRequest $request, Coffee $coffee)
    {
        $coffee->update($request->validated());
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coffee $coffee)
    {
        $coffee->delete();
        return Redirect::back();
    }
}
