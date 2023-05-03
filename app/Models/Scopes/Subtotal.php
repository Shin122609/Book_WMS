<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Subtotal implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $sql = 'select orders.id as id 
        , items.id as item_id
        , item_order.id as pivot_id 
        , items.number_stock - (items.number_stock - item_order.quantity) as subtotal
        , customers.name as customer_name 
        , customers.id as customer_id 
        , items.name as item_name 
        , items.author as item_author
        , items.number_stock as item_number_stock
        , items.number_stock - (items.number_stock - (items.number_stock - item_order.quantity)) as last_stock
        , item_order.quantity 
        , orders.status 
        , orders.created_at 
        , orders.updated_at 
        from orders 
        left join item_order on orders.id = item_order.order_id 
        left join items on item_order.item_id = items.id 
        left join customers on orders.customer_id = customers.id 
        ';

        $builder->fromSub($sql, 'order_subtotals');
    }
}
