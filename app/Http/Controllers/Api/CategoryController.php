<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Requests\Category\{
    CategoryUpdateRequest,
    CategoryStoreRequest
};
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(CategoryStoreRequest $request)
    {
        return Category::create($request->validated());
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        $category->fresh();
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
