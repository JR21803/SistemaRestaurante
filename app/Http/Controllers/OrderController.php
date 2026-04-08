<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() { return Order::all(); }

    public function store(Request $request)
    {
        return Order::create($request->all());
    }

    public function show($id)
    {
        return Order::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return $order;
    }

    public function destroy($id)
    {
        Order::destroy($id);
        return ['message' => 'deleted'];
    }

    public function details($id)
    {
        return ['message' => 'Detalles'];
    }

    public function addDetail($id, Request $request)
    {
        return ['message' => 'Detalle agregado'];
    }
}