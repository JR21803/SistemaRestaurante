<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function index() { return Invoice::all(); }

    public function store(Request $request)
    {

        $request->validate([
            'order_id' => 'required|exists:orders,id|unique:invoices,order_id',
        ]);

        $order = Order::findOrFail($request->order_id);

        if (!$order) {
            return response()->json(['error' => 'Inventario no encontrado'], 404);
        }

        
        
        return Invoice::create([
            'order_id' => $request->order_id,
            'subtotal' => $order->total,
            'taxes' => $request->taxes,
            'total' => $order->total + $request->taxes
        ]);

        
    }

    public function show($id)
    {
        return Invoice::findOrFail($id);
    }
}