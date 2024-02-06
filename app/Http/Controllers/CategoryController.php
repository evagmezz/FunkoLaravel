<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        if ($categories) {
            return $categories->toJson();
        } else {
            return response()->json(['message' => 'No categories found'], 404);
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return $category->toJson();
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json(['message' => 'Category created'], 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->name;
            $category->save();
            return response()->json(['message' => 'Category updated'], 200);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category deleted'], 200);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }
}
