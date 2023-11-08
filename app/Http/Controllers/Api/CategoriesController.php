<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories], 200);
    }

    public function show(Category $category)
    {
        return response()->json(['category' => $category], 200);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        return response()->json(['category' => $category], 201);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return response()->json(['category' => $category], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(["message" => "deleted successfully"], 200);
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return response()->json(['category' => $category], 200);
    }

}
