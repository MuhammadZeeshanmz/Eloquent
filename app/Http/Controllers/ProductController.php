<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\ApiTrait;

class ProductController extends Controller
{
    use AuthorizesRequests, ProductTrait, ApiTrait;
    public function index(Request $request)
    {

        if (!$request->user()->hasPermission('Access ')) {
            $products = Product::with('category')->get();
            return ProductResource::collection($products);
        }
    }
    public function store(ProductRequest $request)
    {
        try {
            if (!$request->user()->hasPermission('Access and create')) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }


            $product = new Product();
            $saved = $this->saveProduct($product, $request->all());
            return new ProductResource($saved);
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function update(ProductRequest $request, $id)
    {
        try {
            if (!$request->user()->hasPermission('Access and Modify')) {
                return $this->error('Unauthorized', 403);
            }

            $product = Product::findOrFail($id);
            $update = $this->saveProduct($product, $request->all());
            return new ProductResource($update);
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function delete($id, $request)
    {
        if (!$request->user()->hasPermission('Access and Delete')) {
            return $this->error('Unauthorized', 403);
        }
        $product = Product::findOrFail($id);
        $product->delete();
    }


    public function show(Request $request, $id)
    {
        try {
            if (!$request->user()->hasPermission('Access')) {

                return $this->error('Unauthorized', 403);
            }
            $product = Product::with('categories')->findOrFail($id);

            return new ProductResource($product);
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
