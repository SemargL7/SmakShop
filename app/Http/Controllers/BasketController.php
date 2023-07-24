<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

class BasketController extends Controller
{
    function show(){
        if (!session()->has('basket')) {
            session()->put('basket', []);
        }

        $basket_item_ids = session()->get('basket');
        $items = Item::whereIn('id',$basket_item_ids)->with(['images'])->get();
        $items->filterFirstImage();
        return view('basket', compact('items'));
    }

    function store(Request $request){

        // Validate the request data, if needed
        $validatedData = $request->validate([
            'checkout.phone' => 'required|string|max:255',
            'checkout.name' => 'required|string|max:255',
            'checkout.email' => 'nullable|email|max:255',
            'formData' => 'required|json',
        ]);

        // Parse the JSON data
        $formData = json_decode($validatedData['formData'], true);

        // Store the form data and perform any additional actions as needed
        // For example, saving the data to the database:
        $order = new Order();
        $order->user_phone = $formData['phone'];
        $order->user_name = $formData['name'];
        $order->user_email = $formData['email'];

        $order->save();

        // You can also loop through the items and save them if needed
        foreach ($formData['items'] as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->item_id = $item['id'];
            $orderItem->quantity = $item['count'];
            $orderItem->save();
        }

        session()->put('basket', []);
        // Optionally, you can send a response back to the client
        return response()->json(['message' => 'Order submitted successfully']);
    }

    function removeItem($product_id){
        $items = session()->get('basket');
        $items = array_filter($items, function ($item) use ($product_id) {
            return $item !== $product_id;
        });
        session()->put('basket', $items);
        return response()->redirectTo('basket');
    }
}
