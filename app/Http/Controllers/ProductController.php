<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ProductTrait;
    public function index() {}
    public function store(ProductRequest $request)
    {
        try {

            $product = new product();
            $saved = $this->saveProduct($product, $request->all());
            return new ProductResource($saved);



            // $data = Product::create([
            //     'name' => $request->name,
            //     'category_id' => $request->category_id,
            //     'description' => $request->description,
            //     'quantity' => $request->quantity,
            //     'price' => $request->price,

            // ]);
            // return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function update(ProductRequest $request, $id)
    {
        try {



            $product = Product::findOrFail($id);
            $update = $this->saveProduct($product, $request->all());
            return new ProductResource($update);
            // $data->update([
            //     'name' => $request->name,
            //     'category_id' => $request->category_id,
            //     'description' => $request->description,
            //     'quantity' => $request->quantity,
            //     'price' => $request->price,
            // ]);
            // return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function delete($id)
    {
        $prduct = Product::findOrFail($id);
        $prduct->delete();
    }


    public function show($id)
    {
        try {
            $product = Product::with('categories')->findOrFail($id);

            return new ProductResource($product);
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
