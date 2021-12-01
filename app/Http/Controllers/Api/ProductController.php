<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProductsById($id)
    {
        $related_products = DB::table('related_products')->where('product_id_s', $id)->pluck('product_id_t')->toArray();
        $products = DB::table('products2')->whereIn('id', $related_products)->get();

        return response()->json(ProductResource::collection($products));
    }
}
