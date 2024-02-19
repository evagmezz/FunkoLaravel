<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::search($request->search)->orderBy('name', 'asc')->paginate(5);

        return view('category.index')->with('categories', $categories);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            flash('Category not found')->error();
        }
        return view('category.show', compact('category'));
    }

    public function store()
    {
        return view('category.create');
    }

    public function create(Request $request)
    {
        $categoryExist = Category::where('name', $request->name)->first();
        if ($categoryExist) {
            flash('Category name already exists')->error();
            return redirect()->back();
        } else if (!$request->name) {
            flash('Category name is required')->error();
            return redirect()->back();
        }
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        flash('Category created')->success();
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $categoryExist = Category::where('name', $request->name)->first();
        if ($categoryExist) {
           flash('Category name already exists')->error();
        }
        else if (!$request->name) {
            flash('Category name is required')->error();
        }
        $category = Category::find($id);
        if ($category) {
            $category->name = $request->name;
            $category->save();
            return redirect()->route('category.index')->with('message', 'Category updated');
        } else {
            flash('Category not found')->error();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            if(!$category->hasFunko()){
            $category->is_deleted = 1;
            $category->save();
            flash('Category deleted')->success();
            return redirect()->route('category.index');
            } else {
                flash('Category has funkos assigned')->error();
                return redirect()->back();
            }
        } else {
            flash('Category not found')->error();
            return redirect()->back();
        }
    }

    public function activate($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->is_deleted = 0;
            $category->save();
            flash('Category activated')->success();
            return redirect()->route('category.index');
        } else {
            flash('Category not found')->error();
            return redirect()->back();
        }
    }
}
