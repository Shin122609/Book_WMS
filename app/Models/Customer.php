<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = 
    ['name','kana','tel','email',
    'postcode','address', 'birthday',
    'gender', 'memo'];


    public function scopeSearchCustomers($query, $input = null) 
 { 
        if(!empty($input)){ 
            if(Customer::where('kana', 'like', $input . '%' ) 
            ->orWhere('tel', 'like', $input . '%')->exists()) 
            { 
                return $query->where('kana', 'like', $input . '%' ) 
                ->orWhere('tel', 'like', $input . '%'); 
            } 
        } 
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
