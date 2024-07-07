<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function placeOrder(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'phone' => 'required|string|regex:/^\+20[0-9]{10}$/',
                'email' => 'required|string|email|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 422, 'errors' => $validator->errors()]);
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
            ]);

            $cartItems = Cart::where('user_id', Auth::id())->get();
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->product_quantity,
                    'price' => $item->product->price,
                ]);
            }

            Cart::where('user_id', Auth::id())->delete();

            return response()->json(['status' => 200, 'message' => 'Order placed successfully']);
        } catch (\Exception $e) {
            Log::error('Order Placement Error: ' . $e->getMessage());
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'error' => $e->getMessage()]);
        }
    }
}
