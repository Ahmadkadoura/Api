<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StorCategoryRequests;
use App\Http\Requests\Category\updateCategoryRequests;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductCategoryResource;
use App\Models\Category;
//use App\Models\product;
use Symfony\Component\HttpFoundation\Response;

 class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum' ]);
        $this->middleware(['check_admin'])->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function store(StorCategoryRequests $request)
    {
        $category_data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = 'categories/' . uniqid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $category_data['image'] = $name;
        }
        $category = Category::create($category_data);
        return $this->showOne($category, CategoryResource::class, __('insert successfully'), 200);

        return new CategoryResource($category);
    }

    public function update(updateCategoryRequests $request, Category $category)
    {
        $category_data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = 'categories/' . uniqid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $category_data['image'] = $name;
        }
        $category->update($category_data);
        return $this->showOne($category, CategoryResource::class, __('update successfully'), 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response(__('deleted successfully'), Response::HTTP_OK);
    }

    public function getProductCategory(Category $category)
    {
        $categoryWithProducts = Category::with('product')->find($category->id);
        return new ProductCategoryResource($categoryWithProducts);
    }
   
}
