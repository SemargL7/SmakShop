<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Image;
use App\Models\Item;
use Illuminate\Http\Request;

class AdminCreateProductController extends Controller
{
    function show(){
        $categories = Category::all();
        return view('admin.createProduct', compact('categories'));
    }
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'code' => 'required|numeric',
                'description' => 'required|string|max:2000',
                'price' => 'required|numeric',
                'count_available' => 'required|numeric',
                'count_total' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'image.*' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg'
            ]);

            $product = new Item();
            $product->name = $validatedData['name'];
            $product->code = $validatedData['code'];
            $product->description = $validatedData['description'];
            $product->price = $validatedData['price'];
            $product->count_available = $validatedData['count_available'];
            $product->count_total = $validatedData['count_total'];
            $product->category_id = $validatedData['category_id'];
            $product->save();

            if ($request->has('characteristics')) {
                $characteristics = $request->input('characteristics');
                $values = $request->input('value');
                $characteristicsData = [];

                foreach ($characteristics as $index => $characteristic) {
                    $value = $values[$index];
                    $characteristicsData[] = [
                        'name' => $characteristic,
                        'value' => $value,
                        'item_id' => $product->id
                    ];
                }

                Characteristic::insert($characteristicsData);
            }

            // Handle product images if uploaded
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $name = $file->getClientOriginalName();
                    $imageData = file_get_contents($file);

                    $imageSize = $file->getSize();
                    $imageType = $file->getClientMimeType();

                    $position = strpos($name, '.');
                    $imageCategory = ($position !== false) ? substr($name, $position + 1) : 'bin';

                    try {
                        $imageModel = new Image();
                        $imageModel->image_type = $imageType;
                        $imageModel->image = $imageData;
                        $imageModel->image_size = $imageSize;
                        $imageModel->image_ctgy = $imageCategory;
                        $imageModel->image_name = $name;
                        $imageModel->item_id = $product->id;
                        $imageModel->save();
                    } catch (\Illuminate\Database\QueryException $e) {
                        // Log or display the error message
                        dd($e->getMessage());
                    }
                }
            }

            return redirect()->back()->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            dd($e, $request);
        }
    }
}
