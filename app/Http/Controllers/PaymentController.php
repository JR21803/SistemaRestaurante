<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }

        if ($request->amount < $order->total) {
            return response()->json(['error' => 'Monto insuficiente'], 400);
        }

        $payment = Payment::create([
            'order_id' => $order->id,
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->amount,
            'status' => 'paid'
        ]);

        $order->status = 'completed';
        $order->save();

        return $payment;
    }
}