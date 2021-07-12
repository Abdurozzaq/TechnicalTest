<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Http\Requests\Category\DeleteCategoryRequest;
use Redirect;

class CategoryController extends Controller
{
    // Create Category View For Operator
    public function createCategoryIndex() {
        return Inertia::render('CategoryManagement/CreateCategory');
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        $validated = $request->validated();

        Category::create([
            'category_name' => $validated['category_name'],
            'category_description' => $validated['category_description'],
        ]);

        return Redirect::back();
    }

    // List of Category View For Operator
    public function categoryListIndex() {
        $category = Category::all();
        return Inertia::render('CategoryManagement/CategoryList', ['data' => $category]);
    }

    // Edit Category
    public function editCategory(EditCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::findOrFail($validated['id']);
        $category->category_name = $validated['category_name'];
        $category->category_description = $validated['category_description'];
        $category->save();

        return Redirect::back();
    }

    public function deleteCategory (DeleteCategoryRequest $request) {
        $validated = $request->validated();
  
        $category = Category::findOrFail($validated['id']);
        $category->delete();
  
        return Redirect::back();
    }
}
