<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{

   public function show($id)
{
    $order = Order::with('orderDetails')->findOrFail($id);
    return view('dashboard.orders.show', compact('order'));
}


public function updateStatus(Request $request, $orderId)
{
    $request->validate([
        'status' => 'required|in:accepted,processing,shipped',
        'tracking_number' => 'nullable|string|max:255',
    ]);

    $order = Order::findOrFail($orderId);
    $order->status = $request->status;

    if ($request->status === 'shipped') {
        if (!$request->tracking_number) {
            return back()->withErrors(['tracking_number' => 'Nomor resi harus diisi jika status dikirim.']);
        }

        $order->tracking_number = $request->tracking_number;

        try {
            Http::post('https://api.phb-umkm.my.id/api/orders/shipped', [
                'order_id' => $order->id,
                'tracking_number' => $order->tracking_number,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['hub_umkm' => 'Gagal mengirim data ke Hub UMKM.']);
        }
    }

    $order->save();

    return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
}



    public function edit($id)
{
    $order = Order::with('orderDetails')->findOrFail($id);
    return view('dashboard.orders.edit', compact('order'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,accepted,processing,shipped,completed',
        'tracking_number' => 'nullable|string|max:255',
    ]);

    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->tracking_number = $request->tracking_number;
    $order->save();

    return redirect()->route('orders.edit', $order->id)->with('success', 'Pesanan diperbarui.');
}

    
    public function index()
    {
        // Eager load relationships to reduce queries
        $orders = Order::with(
            [
                'customer', 
                'items'=>function($query){
                    $query->orderByDesc('created_at');
                },
                'items.product'
            ]
        )->withCount(['items'])
        ->get();
        

        $orderData = [];
        foreach($orders as $key=>$order)
        {
            $customer = $order->customer;
            $items = $order->items;
            $totalAmount = 0;
            $itemsCount = count($order->items);   
            $completedOrderExists = [];

            foreach($items as $keyItem=>$item)
            {
                $product = $item->product;
                $totalAmount += $item->price * $item->quantity;

                if($keyItem === 0) {
                    // Get the last added to cart time for the first item
                    $lastAddedToCart = $item->created_at;
                }
            }

            // Check if the order is completed
            if($order->status === 'completed') {
                $completedOrderExists = true;
            }
            else {
                $completedOrderExists = false;
            }

            $orderData[] = [
            'order_id' => $order->id,
            'customer_name' => $customer->name,
            'total_amount' => $totalAmount,
            'items_count' => $itemsCount,
            'last_added_to_cart' => $lastAddedToCart,
            'completed_order_exists' => $completedOrderExists,
            'created_at' => \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y'),
            'completed_at' => $completedOrderExists ? \Carbon\Carbon::parse($order->completed_at)->translatedFormat('d M Y') : null,
            'status' => $order->status, // <- tambahkan ini jika belum ada
        ];

        }

        
        // Sort by completed_at descending, nulls last
        usort($orderData, function($a, $b) {
            $aCompletedAt = $a['completed_at'] ? strtotime($a['completed_at']) : 0;
            $bCompletedAt = $b['completed_at'] ? strtotime($b['completed_at']) : 0;
            return strtotime($bCompletedAt) - strtotime($aCompletedAt);
        });

        return view('dashboard.orders.index', ['orders' => $orderData]);
    }
}