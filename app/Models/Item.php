<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author',
        'maker',
        'isbn',
        'number_stock',
        'is_stocking',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)
        ->withPivot('quantity');
    }


}
