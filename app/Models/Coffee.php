<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coffee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'user_id',
        'name',
        'size',
        'note',
    ];

    protected $casts = [
        //
    ];

    protected static function booted()
    {
        //
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('id', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('size', 'like', '%' . $search . '%')
            ->orWhere('note', 'like', '%' . $search . '%');
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search']) && !empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['trashed'])) {
            if ($filters['trashed'] === 'true') {
                $query->onlyTrashed();
            } elseif ($filters['trashed'] === 'false') {
                $query->whereNull('deleted_at');
            }
        }

        return $query;
    }

    public function scopeSelectAttributes($query)
    {
        //
    }

    public function appendAttributes()
    {
        //
    }

    //loadrelations
    public function loadRelations(Coffee $coffee)
    {
        $coffee->load(['order', 'user']);
    }
}
