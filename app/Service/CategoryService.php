<?php

namespace App\Service;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class CategoryService
{

    public function createCategory($request)
    {
        $data = Category::create([
            'name' => $request->name,
        ]);
        $this->updateProduct($request, $data);
        return true;
    }

    // private function createProduct($request, $id)
    // {
    //     if (!empty($request->products)) {
    //         foreach ($request->products as $product) {
    //             $product = Product::create([
    //                 'category_id' => $id->id,
    //                 'name' => $product['name'],
    //                 'description' => $product['description'],
    //                 'quantity' => $product['quantity'],
    //                 'price' => $product['price']
    //             ]);
    //         }
    //     }
    //     return $product;
    // }
    public function upadteCategory($request, $id)
    {
        try {
            //code...
              $data = Category::findOrFail($id);
        $data->update([
            'name' => $request->name,
        ]);
        $this->updateProduct($request, $data);
        return $data;
        } catch (\Throwable $th) {
            return $th;
        }
      
    }
    private function updateProduct($request, $data)
    {
        try {
            //code...
                 if (!empty($request->products)) {
            foreach ($request->products as $product) {
                $product = Product::updateOrCreate(
                    [
                        'id' => $request['id'],
                        'category_id' => $data->id,

                    ],
                    [
                        'name' => $product['name'],
                        'description' => $product['description'],
                        'quantity' => $product['quantity'],
                        'price' => $product['price'],

                    ]
                );
            }
        }
        return $product;
    
        } catch (\Throwable $th) {
            return $th;
        }
    }
   
}
