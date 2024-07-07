<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            $product = Product::findOrFail($request->product_id);
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'product_quantity' => $request->quantity,
                'price' => $product->price 
            ]);

            return response()->json([
                'message' => 'Product added to cart successfully',
                'cart' => $cart
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to add product to cart',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

   
    public function removeFromCart($cartId)
    {
        $cart = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();

        if (!$cart) {
            return response()->json([
                'message' => 'Cart item not found'
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'message' => 'Product removed from cart successfully'
        ], 200);
    }
    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        return response()->json([
            'message' => 'Cart retrieved successfully',
            'cart' => $cartItems
        ], 200);
    }

    
    public function editCart(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'scope' => 'required|string|in:inc,dec'
        ]);
    
        $cart = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();
    
        if (!$cart) {
            return response()->json([
                'message' => 'Cart item not found'
            ], 404);
        }
    
        if ($request->scope === 'inc') {
            $cart->product_quantity += 1;
        } elseif ($request->scope === 'dec') {
            $cart->product_quantity -= 1;
    
            if ($cart->product_quantity < 1) {
                return response()->json([
                    'message' => 'Product quantity cannot be less than 1'
                ], 400);
            }
        }
    
        $cart->save();
    
        return response()->json([
            'message' => 'Cart item updated successfully',
            'cart' => $cart
        ], 200);
    }
    
}
