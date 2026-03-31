<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Invoice;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'state' => 'completa'
        ]);

        $line1 = OrderLine::create([
            'order_id' => $order->id,
            'menu_plate_id' => 1,
            'amount' => 2,
            'line_cost' => 17.00
        ]);

        $line2 = OrderLine::create([
            'order_id' => $order->id,
            'menu_plate_id' => 2,
            'amount' => 1,
            'line_cost' => 7.00
        ]);

        $subtotal = $line1->line_cost + $line2->line_cost;
        $taxes = $subtotal * 0.13;
        $total = $subtotal + $taxes;

        Invoice::create([
            'order_id' => $order->id,
            'subtotal' => $subtotal,
            'taxes' => $taxes,
            'total' => $total
        ]);
    }
}