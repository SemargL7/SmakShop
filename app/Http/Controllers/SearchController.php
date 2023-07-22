<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    function show(){
        $lookedItems = Item::whereIn('id', Session::get('looked_items',[]))->with(['reviews','images'])
            ->withCount(['reviews as average_stars' => function ($query) {
            $query->select(DB::raw('COALESCE(AVG(stars), 0)'));
        }])->get();
        $lookedItems->filterFirstImage();
        return view('search', compact('lookedItems'));
    }

    function apiGetFilteredItems()
    {
        // Retrieve the URL parameters
        $category = $_GET['category'] ?? null;
        $priceFrom = $_GET['price_from'] ?? null;
        $priceTo = $_GET['price_to'] ?? null;
        $filter = $_GET['filter'] ?? null;

        // Build the query based on the filters
        $query = Item::query()->withCount(['reviews as average_stars' => function ($query) {
            $query->select(DB::raw('COALESCE(AVG(stars), 0)'));
        }]);

        if ($category !== null) {
            $query->where('category', $category);
        }

        if ($priceFrom !== null) {
            $query->where('price', '>=', $priceFrom);
        }

        if ($priceTo !== null) {
            $query->where('price', '<=', $priceTo);
        }

        if ($filter !== null) {
            $query->where(function ($q) use ($filter) {
                $q->where('name', 'like', "%$filter%")
                    ->orWhere('description', 'like', "%$filter%");
            });
        }

        // Execute the query and retrieve the items
        $items = $query->get();
        foreach ($items as $item){
            $item->image = Image::where('item_id', $item->id)->first();
        }

        // Return a JSON response
        return response()->json($items);
    }

}
