<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Inertia\Inertia; 
use App\Models\Customer; 
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Models\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Log::paginate(50));

        $logs = Log::groupBy('id')
        ->selectRaw('id, sum(subtotal) as total,
        customer_name,status,created_at')
        ->paginate(50);

        // dd($orders);

        return Inertia::render('Orders/Index',[
            'logs' => $logs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $customers = Customer::select('id','name','kana')->get();
        $items = Item::select('id','name','author','number_stock')
        ->where('is_stocking',true)
        ->get();

        return Inertia::render('Orders/Create',[
            // 'customers' => $customers,
            'items' => $items 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        // dd($request);

        DB::beginTransaction();

        try{
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'status' => $request->status,
            ]);
    
            foreach($request->items as $item){
                $order->items()->attach($order->id,[
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity']
                ]);
            }

            DB::commit();
    
            return to_route('dashboard');
    

        } catch(\Exception $e){
            DB::rollBack();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //小計
        $items = Log::where('id', $order->id)->get();

        //合計
        $log = Log::groupBy('id')
        ->where('id', $order->id)
        ->selectRaw('id, sum(subtotal) as total,
        customer_name,status,created_at')
        ->get();

        // dd($items, $log);
        return Inertia::render('Orders/Show',[
            'items' => $items,
            'log' => $log,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order = Order::find($order->id);

        $allItems = Item::select('id','name','author','number_stock','is_stocking')->get();

        $items = [];

        foreach($allItems as $allItem) {
            $quantity = 0;
            foreach($order->items as $item){
                if($allItem->id === $item->id){
                    $quantity = $item->pivot->quantity;
                }
            }

            array_push($items,[
                'id' => $allItem->id,
                'name' => $allItem->name,
                'author' => $allItem->author,
                'is_stocking' => $allItem->is_stocking,
                'number_stock' => $allItem->number_stock,
                'quantity' => $quantity,

            ]);
        }

        // dd($items);

        $log = Log::groupBy('id')
        ->where('id', $order->id)
        ->selectRaw('id, customer_id,
        customer_name, status, created_at')
        ->get();

        return Inertia::render('Orders/Edit', [
            'items' => $items,
            'log' => $log, 
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        DB::beginTransaction();

        try{
        // dd($request, $purchase);
        $order->status = $request->status;
        $order->save();

        $items = [];

        foreach($request->items as $item){
            $items = $items + [
                $item['id'] => [
                    'quantity' => $item['quantity']
                ]
            ];
        }

        // dd($items);
        $order->items()->sync($items);

        DB::commit();
        return to_route('dashboard');
    } catch(\Exception $e){
        DB::rollback();
    }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
