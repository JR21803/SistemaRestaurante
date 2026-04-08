<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() { return Client::all(); }

    public function store(Request $request)
    {
        
        $request->validate([
            'user_id' => 'required|unique:clients,user_id',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        if (Client::where('user_id', $request->user_id)->exists()) {
            return response()->json(['message' => 'User_id ya está registrado', 
            'errors' => ['user_id' => ['El user_id ya está existe']]], 422);
        }

        return Client::create($request->all());
    }

    public function show($id)
    {
        return Client::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return $client;
    }

    public function destroy($id)
    {
        Client::destroy($id);
        return ['message' => 'deleted'];
    }
}