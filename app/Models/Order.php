<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'amount',
        'cost',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    protected static function booted()
    {
        //set user ordering to true
        static::creating(function ($order) {
            $order->user->ordering = true;
            $order->user->save();
        });
        //when order completed is true, set user ordering to false
        static::updating(function ($order) {
            if ($order->completed) {
                $order->user->ordering = false;
                $order->user->save();
            }
        });
    }

    public function coffees()
    {
        return $this->hasMany(Coffee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('id', 'like', '%' . $search . '%')
            ->orWhere('amount', 'like', '%' . $search . '%')
            ->orWhere('cost', 'like', '%' . $search . '%');
    }

    public function scopeSelectAttributes($query)
    {
        //
    }

    public function scopeFilter($query, array $filters)
    {
        // Implement your filtering logic here
        if (isset($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['trashed'])) {
            $query->whereNotNull('deleted_at');
        }

        return $query;
    }

    public function appendAttributes()
    {
        //
    }

    public function loadRelations(Order $order)
    {
        $order->load(['coffees', 'user']);
    }

}
