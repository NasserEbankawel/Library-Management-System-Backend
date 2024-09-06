<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;


class CartController extends Controller
{
    
    /**
     * Display a listing of the carts.
     */
    public function index()
    {
        $carts = Cart::with('user')->get();
        return response()->json($carts);
    }

    /**
     * Store a newly created cart in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $cart = Cart::create($data);

        return response()->json([
            'message' => 'Cart created successfully',
            'cart' => $cart
        ]);
    }

    /**
     * Display the specified cart.
     */
    public function show(string $id)
    {
        $cart = Cart::with('user')->findOrFail($id);
        return response()->json($cart);
    }

    /**
     * Update the specified cart in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->update($data);

        return response()->json([
            'message' => 'Cart updated successfully',
            'cart' => $cart
        ]);
    }

    /**
     * Remove the specified cart from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return response()->json([
            'message' => 'Cart deleted successfully'
        ]);
    }
}

