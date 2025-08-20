<?php

namespace App\Traits;

use App\Models\Product;

trait ProductTrait
{
    public function saveProduct($product, $data)
    {
        $product->name = $data['name'];
        $product->category_id = $data['category_id'];
        $product->description = $data['description'];
        $product->quantity = $data['quantity'];
        $product->price = $data['price'];
        $product->save();

        return $product;
    }
}
