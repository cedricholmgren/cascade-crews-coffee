<?php

namespace App\Http\Middleware;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            // Synchronously...
            'appName' => config('app.name'),

            // Lazily...
            // 'anyActiveOrders' => fn() => Order::where('completed', false)->exists(),
            'activeOrdersIds' => fn() => Order::where('completed', false)->pluck('id'),

            //is actve user ordering
            'userOrdering' => fn() => User::where('id', Auth::id())->where('ordering', true)->exists(),

            'lastUserCoffee' => fn() => Auth::check() ? User::where('id', Auth::id())->latest()->first()->coffees()->latest()->first() : null,
            //look through the orders of the user and add up the amount field and return it as a prop

            'orderAmount' => fn() => Auth::check() ? User::where('id', Auth::id())->latest()->first()->orders()->where('completed', true)->sum('amount') : null,

            'totalCoffees' => fn() => Auth::check() ? User::where('id', Auth::id())->latest()->first()->coffees()->count() : null,

        ]);
    }
}
