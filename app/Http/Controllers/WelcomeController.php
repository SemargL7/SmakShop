<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class WelcomeController extends Controller
{
    function show()
    {

        $popular_items = Item::with(['reviews','images'])->withCount(['reviews as average_stars' => function ($query) {
            $query->select(DB::raw('COALESCE(AVG(stars), 0)'));
        }])
            ->withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->take(10)
            ->get();
        $popular_items->filterFirstImage();// this function is created in Providers/AppServiceProvider in boot

        $newest_items = Item::with(['reviews','images'])->withCount(['reviews as average_stars' => function ($query) {
            $query->select(DB::raw('COALESCE(AVG(stars), 0)'));
        }])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $newest_items->filterFirstImage();

        $preview_categories = Category::with(['images'])->whereNull('parent_id')->get();
        $preview_categories->filterFirstImage();
        $lookedItems = Item::whereIn('id', Session::get('looked_items',[]))->with(['reviews','images'])
            ->withCount(['reviews as average_stars' => function ($query) {
            $query->select(DB::raw('COALESCE(AVG(stars), 0)'));
        }])->get();
        $lookedItems->filterFirstImage();
//        dd(compact('popular_items', 'newest_items', 'preview_categories', 'lookedItems'));
        return view('welcome', compact('popular_items', 'newest_items', 'preview_categories', 'lookedItems'));
    }
}
