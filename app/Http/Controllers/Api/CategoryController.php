<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\{
    CategoryUpdateRequest,
    CategoryStoreRequest
};
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());
        $category->refresh();
        return $category;
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
