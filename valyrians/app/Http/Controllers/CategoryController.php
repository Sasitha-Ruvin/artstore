<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
        // return view('categories.index', compact('categories'));
    }

    public function getCategoriesForView()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
        ]);
        $category = Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
        return new CategoryResource($category);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();

        return \response()->json(null,204);
    }
}
