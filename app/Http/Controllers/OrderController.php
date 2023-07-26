<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Orders/Index', [
            'filters' => Request::all('search', 'trashed'),
            'orders' => Order::orderBy('id', 'desc')
                ->filter(Request::only('search', 'trashed'))
                ->paginate()
                ->withQueryString()
                ->through(function ($order) {
                    return [
                        'id' => $order->id,
                        'user_id' => $order->user_id,
                        'amount' => $order->amount,
                        'cost' => $order->cost,
                        'created_at' => $order->created_at,
                        'deleted_at' => $order->deleted_at,
                    ];
                }),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        Order::create($request->validated());
        //redirect to the show page of the newly created order
        return Redirect::route('orders.show', Order::latest()->first());
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Eager load the 'coffee' relationship
        $order->load('coffees');

        return Inertia::render('Orders/Show', [
            'order' => [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'amount' => $order->amount,
                'cost' => $order->cost,
                'created_at' => $order->created_at,
                'deleted_at' => $order->deleted_at,
                'coffees' => $order->coffees, // Access the loaded 'coffee' relationship
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return Redirect::back();
    }
}
