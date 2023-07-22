<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    function show(){
        $items = Item::with(['images' => function ($query) {
            $query->orderBy('id')->take(1);
        }])->paginate(10);
        return view('admin.productList', compact('items'));
    }
}
