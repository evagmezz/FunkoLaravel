<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Funko;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FunkoController extends Controller
{
    public function index(Request $request)
    {
        $funkos = Funko::search($request->search)->orderBy('id', 'asc')->paginate(3);
        return view('funkos.index')->with('funkos', $funkos);
    }

    public function show($id)
    {
        $funko = Funko::find($id);
        if (!$funko) {
            flash('Funko not found')->error();
            return redirect()->route('funkos.index');
        }
        return view('funkos.show', compact('funko'));
    }

    public function create()
    {
        $categories = Category::where('is_deleted', 0)->get();
        return view('funkos.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:2|string',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ], $this->messages());

        if ($validator->fails()) {
            $this->flash($this->messages())->error();
        }
        try {
            $funko = new Funko($request->all());
            $funko->category_id = $request->category_id;
            $funko->save();
            flash('Funko created')->success();
            return redirect()->route('funkos.index');
        } catch (Exception $e) {
            flash('Cannot create Funko' . $e->getMessage())->error();
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $funko = Funko::find($id);
        $categories = Category::all();
        return view('funkos.edit', compact('funko', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $funko = Funko::find($id);
        if ($funko) {
            $validator = Validator::make($request->all(), [
                'name' => 'max:255|min:2|string',
                'price' => 'numeric|min:1',
                'stock' => 'integer|min:0',
                'category_id' => 'string'
            ], $this->messages());

            if ($validator->fails()) {
                flash($this->messages())->error();
                return response()->json(['errors' => $validator->errors(), 400]);
            }
            $funko->name = $request->name;
            $funko->price = $request->price;
            $funko->stock = $request->stock;
            $funko->category_id = $request->category_id;
            $funko->save();
            flash('Funko updated')->success();
            return redirect()->route('funkos.index');
        } else {
            flash('Cannot update Funko')->error();
            return redirect()->back();
        }
    }

    public function editImg($id)
    {
        $funko = Funko::find($id);
        return view('funkos.image', compact('funko'));
    }

    public function updateImg(Request $request, $id)
    {
        $funko = Funko::find($id);
        if ($funko) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ], $this->messages());

            if ($validator->fails()) {
                flash($this->messages())->error();
                return redirect()->back()->withInput();
            }
            if ($funko->image != Funko::$IMAGE_DEFAULT && Storage::exists($funko->image)) {
                Storage::delete($funko->image);
            }
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $fileToSave = time() . $fileName;
            $image->storeAs('public/funko', $fileToSave);
            $funko->image = $fileToSave;
            $funko->save();
            flash('Funko image updated')->success();
            return redirect()->route('funkos.index');
        } else {
            flash('Cannot update Funko image')->error();
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        $funko = Funko::find($id);
        if ($funko) {
            if ($funko->image != Funko::$IMAGE_DEFAULT && Storage::exists($funko->image)) {
                Storage::delete($funko->image);
            }
            $funko->delete();
            flash('Funko deleted')->success();
            return redirect()->route('funkos.index');
        } else {
            flash('Cannot delete Funko')->error();
            return redirect()->back();
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Funko name is required.',
            'name.max' => 'Funko name is too long.',
            'name.min' => 'Funko name is too short.',
            'name.string' => 'Funko name must be a string.',
            'price.required' => 'Funko price is required.',
            'price.numeric' => 'Funko price must be a number.',
            'price.min' => 'Funko price must be at least 1.',
            'stock.required' => 'Funko stock is required.',
            'stock.integer' => 'Funko stock must be an integer.',
            'stock.min' => 'Funko stock must be at least 0.',
            'image.required' => 'Funko image is required.',
            'image.image' => 'Funko image must be an image.',
            'image.mimes' => 'Funko image must be a jpeg, png, or jpg.',
            'image.max' => 'Funko image must be less than 2048 kilobytes.',
            'category_id.required' => 'Funko category is required.',
            'category_id.exists' => 'Funko category does not exist.'
        ];
    }

}
