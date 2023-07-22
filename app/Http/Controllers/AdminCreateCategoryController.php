<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;

class AdminCreateCategoryController extends Controller
{
    function show(){
        $categories = Category::all();
        return view('admin.createCategory', compact('categories'));
    }

    function store(Request $request){
        try{
            $validatedData = $request->validate([
                'name' => 'required|string',
                'category_id' => 'nullable|exists:categories,id',
                'image.*' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg'
            ]);
            $category = new Category();
            $category->name = $validatedData['name'];
            if ($request->input('category_id') != null)
                $category->parent_id = $validatedData['category_id'];
            $category->save();

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
                        $imageModel->category_id = $category->id;
                        $imageModel->save();
                    } catch (\Illuminate\Database\QueryException $e) {
                        // Log or display the error message
                        dd($e->getMessage());
                    }
                }
            }

            return redirect()->back()->with('success', 'Product created successfully.');
        }catch (\Exception $e){
            dd($e);
        }

    }
}
