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
        static::created(function ($order) {
            $order->user->update(['ordering' => true]);
        });

        static::deleted(function ($order) {
            $order->user->update(['ordering' => false]);
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

    public function appendAttributes()
    {
        //
    }

    public function loadRelations(Order $order)
    {
        $order->load(['coffees', 'user']);
    }

}
