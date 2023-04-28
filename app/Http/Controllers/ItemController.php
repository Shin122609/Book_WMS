<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Items/Index',[
            'items' => Item::select('id','name','author','maker','isbn','number_stock','is_stocking')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Items/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        Item::create([
            'name' => $request->name,
            'author' => $request->author,
            'maker' => $request->maker,
            'isbn' => $request->isbn,
            'number_stock' => $request->number_stock,

        ]);

        return to_route('items.index')
        ->with([
            'message'=> '登録しました。',
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        // dd($item);
        return Inertia::render('Items/Show',[
            'item'=>$item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return Inertia::render('Items/Edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        // dd($item->name,$request->name);
        $item->name = $request->name;
        $item->author = $request->author;
        $item->maker = $request->maker;
        $item->isbn = $request->isbn;
        $item->number_stock = $request->number_stock;
        $item->is_stocking = $request->is_stocking;
        $item->save();

        return to_route('items.index')
        ->with([
            'message'=>'更新しました',
            'status' => 'success',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return to_route('items.index')
        ->with([
            'message'=>'削除しました',
            'status' => 'danger',
        ]);
    }
}
