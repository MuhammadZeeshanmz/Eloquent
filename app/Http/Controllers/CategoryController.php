<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()

    {

        $category = Category::with('products')->get();
        


        return response()->json([
            'category' => $category
        ], 200);
    }


    public function store(CategoryRequest $request)
    {
        try {
            $data = Category::create([
                'name' => $request->name,
            ]);
            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
         
            $data = Category::findOrFail($id);
            $data->update([
                'name' => $request->request,
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
    public function show($id)
    {
        try {

            $category = Category::with('products')->findOrFail($id);

            return new CategoryResource($category);
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
