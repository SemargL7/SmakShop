<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    function show($product){
        $item = Item::where('id', $product)->with(['characteristics','images', 'reviews' => function ($query) {
            $query->orderBy('id');
        }])->withCount(['reviews as average_stars' => function ($query) {
            $query->select(DB::raw('COALESCE(AVG(stars), 0)'));
        }])->first();

        if (isset($item)) {
            if (!session()->has('looked_items')) {
                session()->put('looked_items', []);
            }

            $looked_item_ids = session()->get('looked_items');
            if (!in_array($item->id, $looked_item_ids)) {
                $looked_item_ids[] = $item->id;
                session()->put('looked_items', $looked_item_ids);
            }
        }

        $interest_items = Item::where('category_id', $item->category_id)->with(['reviews','images'])->withCount(['reviews as average_stars' => function ($query) {
            $query->select(DB::raw('COALESCE(AVG(stars), 0)'));
        }])->get();
        $interest_items->filterFirstImage();

        $lookedItems = Item::whereIn('id', Session::get('looked_items',[]))->with(['reviews','images'])->withCount(['reviews as average_stars' => function ($query) {
            $query->select(DB::raw('COALESCE(AVG(stars), 0)'));
        }])->get();
        $lookedItems->filterFirstImage();
        return view('product', compact('item', 'lookedItems', 'interest_items'));
    }

    function perform($product){
        if (!session()->has('basket')) {
            session()->put('basket', []);
        }

        $basket_item_ids = session()->get('basket');
        if (!in_array($product, $basket_item_ids)) {
            $basket_item_ids[] = $product;
            session()->put('basket', $basket_item_ids);
        }
        return response()->redirectTo('basket');
    }

    function apiGetItemReviews($item_id) {
        $reviews = ItemReview::where('item_id', $item_id)->get();
        return response()->json($reviews);
    }
}
