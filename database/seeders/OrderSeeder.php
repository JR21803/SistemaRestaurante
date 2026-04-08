<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Database\Seeder;
use App\Models\Invoice;

class OrderSeeder extends Seeder
{
public function run()
{
    $order = Order::create([
        'client_id' => 1,
        'employee_id' => 1,
        'total' => 25,
        'status' => 'pending'
    ]);

    // Factura para la orden
    Invoice::create([
        'order_id' => $order->id,
        'subtotal' => 20,
        'taxes' => 5,
        'total' => 25
    ]);
}
}