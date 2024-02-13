<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::search(request('search'))->paginate(5);
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $categoryExist = Category::where('name', $request->name)->first();
        if ($categoryExist) {
            return redirect()->back()->withErrors(['message' => 'Category name already exists.']);
        } else if (!$request->name) {
            return redirect()->back()->withErrors(['message' => 'Category name is required.']);
        }
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('message', 'Category created');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $categoryExist = Category::where('name', $request->name)->first();
        if ($categoryExist) {
            return redirect()->back()->withErrors(['message' => 'Category name already exists.']);
        }
        else if (!$request->name) {
            return redirect()->back()->withErrors(['message' => 'Category name is required.']);
        }
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->name;
            $category->save();
            return redirect()->route('categories.index')->with('message', 'Category updated');
        } else {
            return redirect()->back()->withErrors(['message' => 'Category not found']);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->is_deleted = 1;
            $category->save();
            return redirect()->route('categories.index')->with('message', 'Category deleted');
        } else {
            return redirect()->back()->withErrors(['message' => 'Category not found']);
        }
    }
}
