<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() { return Invoice::all(); }

    public function store(Request $request)
    {

        $request->validate([
            'order_id' => 'required|exists:orders,id|unique:invoices,order_id',
        ]);
        
        return Invoice::create([
            'order_id' => $request->order_id,
            'subtotal' => 20,
            'taxes' => 5,
            'total' => 25
        ]);

        
    }

    public function show($id)
    {
        return Invoice::findOrFail($id);
    }
}