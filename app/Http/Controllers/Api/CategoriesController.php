<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        // return CategoryResource::collection(Category::get()); 
        // $categories = Category::get();
        // return response()->json(Category::get());

        // $categories = Category::select('id', 'cate_' . app()->getLocale())->get();
        // return response()->json($categories);
        $categories = Category::select('id', 'cate_' . app()->getLocale() . ' as Category name')->get();
        return $this->apiResponse($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->notFoundResponse();
        }

        return $this->apiResponse($category);
    }
}
