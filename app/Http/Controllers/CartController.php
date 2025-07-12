<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
    $user = Auth::guard('customer')->user();

    $cart = Cart::with('items.itemable')
        ->where('user_id', $user->id)
        ->first();

    return view('cart.index', [
        'cart' => $cart,
    ]);
}


    

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::guard('customer')->user(); 
        $product = Product::findOrFail($request->product_id);
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $item = $cart->items()
            ->where('itemable_id', $product->id)
            ->where('itemable_type', Product::class)
            ->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            $cart->items()->create([
                'itemable_id' => $product->id,
                'itemable_type' => Product::class,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function remove($id)
    {
        $user = Auth::guard('customer')->user(); 
        $cart = Cart::where('user_id', $user->id)->first();

        $item = $cart->items()->where('id', $id)->first();
        if ($item) {
            $item->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item dihapus.');
    }

    public function checkout()
    {
        $user = Auth::guard('customer')->user(); 
        $cart = Cart::with('items.itemable')->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $order = Order::create([
            'customer_id' => $user->id,
            'order_date' => now(),
            'total_amount' => 0,
            'status' => 'pending',
        ]);

        $total = 0;
        foreach ($cart->items as $item) {
            $product = $item->itemable;
            $subtotal = $product->price * $item->quantity;

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item->quantity,
                'unit_price' => $product->price,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $order->update(['total_amount' => $total]);
        $cart->items()->delete();

        return redirect()->route('customer.home')->with('success', 'Checkout berhasil!');
    }
}
