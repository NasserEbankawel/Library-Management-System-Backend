<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartitem;
use App\Models\Cart;
use App\Models\Book;

class CartitemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartitems = Cartitem::with(['cart', 'book'])->get();
        return response()->json($cartitems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        $cartitem = Cartitem::create($data);

        return response()->json([
            'message' => 'Item added to cart successfully',
            'cartitem' => $cartitem
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cartitem = Cartitem::with(['cart', 'book'])->findOrFail($id);
        return response()->json($cartitem);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        $cartitem = Cartitem::findOrFail($id);
        $cartitem->update($data);

        return response()->json([
            'message' => 'Cart item updated successfully',
            'cartitem' => $cartitem
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartitem = Cartitem::findOrFail($id);
        $cartitem->delete();

        return response()->json([
            'message' => 'Cart item removed successfully'
        ]);
    }
}

