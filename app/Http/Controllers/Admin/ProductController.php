<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->with(['suppliers', 'price'])->get();
        $suppliers = Supplier::query()->with('products')->get();

        /** @var Product $product */

        $values = [];

        foreach ($products as $product) {
            $price = $product->suppliers->min('pivot.price_dollar');

            if(!is_null($price))
                if (is_null($product->price))
                    Price::query()->create([
                        'product_id' => $product->id,
                        'price' => $price
                    ]);
                else
                    $product->price->update(['price' => $price]);

        }

        return view('admin.list', compact('products'));
    }
}
