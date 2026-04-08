<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function calculate(Request $request)
    {
        if ($request->total < 0) {
            return response()->json(['error' => 'total invalido'], 400);
        }
    
        $total = $request->total;

        if ($total >= 25) {
            return ['total' => $total - 5];
        }

        return ['total' => $total];
    }
}