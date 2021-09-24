<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoriesByPage(Request $request)
    {
        if (Category::count() >= 30) {

            $perPage = 10;
            $request->page = $request->page ?: 1;
            $categories = Category::with('products')->paginate($perPage, ['*'], 'page', $request->page);
            $custom = collect(['has_error' => false, 'message' => 'Categories was found']);
            $res = $custom->merge($categories);
            return response()->json($res);
        }
        $categories = Category::with('products')->get();
        if ($categories) {

            $res = [
                'has_error' => false,
                'message' => 'Category was found',
                'data' => $categories
            ];
        } else {
            $res = [
                'has_error' => false,
                'message' => "Categories wasn't found"
            ];
        }
        return response()->json($res);
    }
    public function categoryProductsByPage(Request $request, $id)
    {
        $category = Category::with('products')->find($id);
        if ($category) {
            if (count($category->products) >= 20) {
                $perPage = 5;
                $request->page = $request->page ?: 1;
                $categories = Category::with('products')->products->paginate($perPage, ['*'], 'page', $request->page);
                $custom = collect(['has_error' => false, 'message' => "Category's products wasn found"]);
                $res = $custom->merge($categories);
            } else {
                $res = [
                    'has_error' => false,
                    'message' => "Category's products was found",
                    'data' => $category->products
                ];
            
            }
        } else {
            $res = [
                'has_error' => true,
                'message' => "Category wasn't found",

            ];
        }
        return response()->json($res);
    }
    public function categoryById($id)
    {
        $category = Category::with('products')->find($id);
        if ($category) {
            $res = [
                'has_error' => false,
                'message' => 'Category was found',
                'data' => $category
            ];
        } else {
            $res = [
                'has_error' => true,
                'message' => "Category wasn't found",

            ];
        }
        return response()->json($res);
    }
    public function searchByName($term)
    {
        $categories = Category::with('products')->where('name', 'LIKE', "%$term%")->get();
        if (count($categories) != 0) {
            $res = [
                'has_error' => false,
                'message' => 'Category was found',
                'data' => $categories
            ];
            return response()->json($res);
        } else {
            $res = [
                'has_errors' => true,
                'message' => 'No Category was found',
            ];
            return response()->json($res);
        }
    }
}
