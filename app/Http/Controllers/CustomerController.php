<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() { return Client::all(); }

    public function store(Request $request)
    {
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