<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Service\CategoryService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller

{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        return $this->categoryService = $categoryService;

        
    }

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
            $data = $this->categoryService->createCategory($request);
            // $data = Category::create([
            //     'name' => $request->name,
            //     'products' => $request->products
            // ]);
            // if (!empty($request->products)) {
            //     foreach ($request->products as $product) {
            //         $product =  Product::create([
            //             'category_id' => $data->id,
            //             'name' => $product['name'],
            //             'description' => $product['description'],
            //             'quantity' => $product['quantity'],
            //             'price' => $product['price'],
            //         ]);
            //     }
            // }
            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function update(Request $request, $id)

    {
        DB::beingTransaction();
        try {
            $data = $this->categoryService->upadteCategory($request, $id);

            // $data = Category::findOrFail($id);
            // $data->update([
            //     'name' => $request->name,
            // ]);
            // if (!empty($request->products)) {
            //     foreach ($request->products as $product) {
            //         $product = Product::updateOrCreate(
            //             [
            //                 'id' => $request['id'],
            //                 'category_id' => $data->id,

            //             ],
            //             [
            //                 'name' => $product['name'],
            //                 'description' => $product['description'],
            //                 'quantity' => $product['quantity'],
            //                 'price' => $product['price'],

            //             ]
            //         );
            //     }
            // }
            DB::commit();
            return $data;
        } catch (\Throwable $th) {
            DB::rollBack();
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
