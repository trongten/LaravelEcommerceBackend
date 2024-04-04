<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

    // Search
    if ($request->has('name')) {
        $query->where('name', 'like', '%'.$request->input('name').'%');
    }
    if ($request->has('sort')) {
        $sort = $request->input('sort');
        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } 
    }

    // Paginate
    $perPage = $request->has('per_page') ? $request->input('per_page') : 10;
    $categories = $query->paginate($perPage);

    return response()->json($categories);
    }

    public function add(CreateCategoryRequest $request)
    {
        $validated = $request->validated();
        Category::insert($validated);

        return response()->json([
            'msg' => 'create categories successfully',
            'data' => $validated
        ], 201);
    }


    public function update(CreateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $validated = $request->validated();
        if (!$category) {
            return response()->json([
                'msg' => 'category is not found'
            ], 404);
        }

        $category->update($validated);

        return response()->json([
            'message' => 'update category successfully',
            'data' => $category
        ], 200);
    }

    
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'msg' => 'category is not found'
            ], 404);
        }

        try {
            $category->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'category in use'
            ], 401);
        }

        return response()->json([
            'msg' => 'delete category successfully',
        ], 200);
    }

}
