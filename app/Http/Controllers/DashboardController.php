<?php

namespace App\Http\Controllers;

//use inerita
//use controller
use App\Http\Controllers\Controller;
use App\Models\Coffee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Retrieve the top users with the most coffee orders
        $topUsers = User::withSum('orders', 'amount')
            ->whereHas('orders', function ($query) {
                $query->where('completed', true);
            })
            ->orderByDesc('orders_sum_amount')
            ->limit(10)
            ->get();

        //get the 10 most popular coffees and the number of times they've been ordered, sort by name
        $popularCoffees = Coffee::select('name', DB::raw('count(*) as total'))
            ->groupBy('name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // You can also call the coffeeCount method on a specific user instance if needed
        // For example:
        // $user = User::find($userId);
        // $coffeeCount = $user->coffeeCount();

        return Inertia::render('Dashboard', [
            'topUsers' => $topUsers,
            'popularCoffees' => $popularCoffees,
        ]);
    }
}
