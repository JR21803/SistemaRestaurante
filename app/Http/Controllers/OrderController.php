<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() { return Order::all(); }

    public function store(Request $request)
        {

            $this->authorize('create', Order::class);

            $validated = $request->validate([
                'client_id' => 'required|exists:clients,id',
                'employee_id' => 'required|exists:employees,id',
                'items' => 'required|array|min:1',
                'items.*.item_id' => 'required|exists:plates,id',
                'items.*.amount' => 'required|integer|min:1',
            ]);



                foreach ($validated['items'] as $itemData) {



                    $itemIds = collect($validated['items'])->pluck('item_id');



                    $plates = Plate::whereIn('id', $itemIds)->get()->keyBy('id');

                    $total = 0;
                    $orderLinesData = [];

                    foreach ($validated['items'] as $itemData) {
                        $item = $plates[$itemData['item_id']] ?? null;

                        if (!$item) {
                            abort(404, 'Plato no encontrado');
                        }

                        $lineCost = $item->price * $itemData['amount'];
                        $total += $lineCost;

                        $orderLinesData[] = [
                            'menu_plate_id' => $item->id,
                            'amount' => $itemData['amount'],
                            'line_cost' => $lineCost,
                        ];
                    }


                    $order = Order::create([
                        'client_id' => $validated['client_id'],
                        'employee_id' => $validated['employee_id'],
                        'total' => $total,
                    ]);


                    foreach ($orderLinesData as &$line) {
                        $line['order_id'] = $order->id;
                    }
                    unset($line); 

                    OrderLine::insert($orderLinesData);
                }

            return response()->json([
            'order_id' => $order->id,
            'client_id' => $order->client_id,
            'employee_id' => $order->employee_id,
            'total' => $order->total,
        ], 201);
        
        
    }

    public function show($id)
    {
        return Order::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('create', Order::class);
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
        $order = Order::with('orderLines')->findOrFail($id);

        return response()->json([
            'order_id' => $order->id,
            'client_id' => $order->client_id,
            'employee_id' => $order->employee_id,
            'total' => $order->total,
            'lines' => $order->orderLines
        ]);
    }

}