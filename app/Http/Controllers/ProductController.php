<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productsByPage(Request $request)
    {
        if (Product::count() >= 30) {

            $perPage = 10;
            $request->page = $request->page ?: 1;
            $products = Product::with('category')->paginate($perPage, ['*'], 'page', $request->page);
            $custom = collect(['has_error' => false, 'message' => 'Products was found']);
            $res = $custom->merge($products);
            return response()->json($res);
        }
        $order = product::get();
        $res = [
            'has_error' => false,
            'message' => 'Products was found',
            'data' => $order
        ];
        return response()->json($res);
        
    }
    public function productById($id)
    {
        $product = Product::with('category')->with('order')->find($id);
        if ($product) {
            $res = [
                'has_error' => false,
                'message' => 'Product was found',
                'data' => $product
            ];
        }else{
            $res = [
                'has_error' => true,
                'message' => "Product wasn't found"
            ];
        }
        
        return response()->json($res);
    }
    public function productCategoryById($id)
    {
        $product = Product::with('category')->find($id);
        if($product)
        {

            $res = [
                'has_error' => false,
                'message' => "Products' Category was found",
                'data' => $product->category
            ];
        }else{
            $res = [
                'has_error' => true,
                'message' => "Product wasn't found"
            ];
        }
        return response()->json($res);
    }

    public function searchByName($term)
    {
        $products = Product::with('category')->where('name', 'LIKE', "%$term%")->get();
        if (count($products)!=0) {
            $res = [
                'has_error' => false,
            'message' => "Products was found",
            'data' => $products
            ];
            return response()->json($res);
        } else {
            $res = [
                'has_errors' => true,
                'message' => 'no product was found',
            ];
            return response()->json($res);
        }
    }
}
