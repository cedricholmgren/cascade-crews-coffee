<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleOrderStatus extends Middleware
{
    protected $allowedRoutes = [
        'logout',
        'users.edit',
        'users.update',
    ];

    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $currentRoute = $request->route()->getName();

        // If user is logging out or viewing the profile page/updating user, return the next request
        if (in_array($currentRoute, $this->allowedRoutes)) {
            return $next($request);
        }

        // Check if the user is ordering and if there's an active order and that they are not already on the order show page
        //if the user  is logged in
        if ($user) {
            if ($user->ordering && $user->activeOrder() !== null && $currentRoute !== 'orders.show') {
                // If the user is ordering and there's an active order, redirect to the order show page
                return redirect()->route('orders.show', ['order' => $user->activeOrder()->id]);
            } elseif (!$user->ordering && $user->activeOrder() !== null && $currentRoute !== 'coffees.create') {
                // If the user is not ordering but there's an active order, redirect to the create coffee page
                return redirect()->route('coffees.create');
            } elseif (!$user->ordering && $user->activeOrder() === null && $currentRoute !== 'dashboard') {
                // If the user is not ordering and there's no active order, direct them to the dashboard page
                return redirect()->route('dashboard');
            }
        }

        if (in_array('coffees.create', $this->allowedRoutes)) {
            $this->allowedRoutes = array_merge($this->allowedRoutes, ['coffee.store', 'coffee.update']);
        }

        // Continue with the next request if none of the above conditions are met
        return $next($request);
    }
}
