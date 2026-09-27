<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items.menu')
            ->latest()
            ->paginate(10);
        return view('pelanggan.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $cartData = json_decode($request->cart_data, true);
        $totalPrice = (int) $request->total_price;

        if (empty($cartData)) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $order = Order::create([
            'order_number' => 'MAD-' . now()->format('Ymd') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT),
            'user_id' => auth()->id(),
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'pickup_datetime' => $request->pickup_datetime,
            'payment_method' => $request->payment_method,
            'payment_status' => 'belum_lunas',
            'pickup_status' => 'belum_diambil',
            'source' => 'online',
            'total_price' => $totalPrice,
            'notes' => $request->notes,
        ]);

        foreach ($cartData as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        return redirect()->route('pelanggan.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Silakan ambil pada waktu yang ditentukan.');
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('items.menu');
        return view('pelanggan.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);

        if (! in_array($order->payment_status, ['belum_lunas'])) {
            return back()->with('error', 'Pesanan tidak bisa dibatalkan pada status ini.');
        }

        $order->delete();
        return redirect()->route('pelanggan.orders.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }
}