<?php

namespace App\Http\Controllers;

use App\Enums\ProductCategoryEnum;
use App\Http\Requests\GetProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetProductRequest $request)
    {
        // validate that each category exists in the table
        $categories = array_filter(explode(',', $request->query('category')));
        if ($categories) {
            foreach ($categories as $category) {
                // do validation logic
                if (!in_array($category, array_column(ProductCategoryEnum::cases(), 'value'))) {
                    return response()->json(
                        [
                            'message' => "The product category passed does not exist"
                        ],
                        422
                    );
                }
            }
        }

        // default 30 results per page if variables not passed
        $perPage = $request->query('per-page') ? $request->query('per-page') : 30;

        // For pagination
        // $products = Product::when($categories, function ($q) use ($categories) {
        //     return $q->whereIn('category', $categories);
        // })
        //     ->when($request->query('order'), function ($q) use ($request) {
        //         // order alphabetically by category name
        //         return $q->orderBy('category', $request->query('order'));
        //     })
        //     ->paginate($perPage);

        $products = Product::when($categories, function ($q) use ($categories) {
            return $q->whereIn('category', $categories);
        })
            ->when($request->query('order'), function ($q) use ($request) {
                // order alphabetically by category name
                return $q->orderBy('category', $request->query('order'));
            })
            ->take(20)
            ->get();
        return response()->json(
            [
                'message' => "The data to be displayed",
                'data' => ProductResource::collection($products)
                // for pagination
                // 'data' => ProductResource::collection($products)->resource
            ],
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->category = $request->category;
        $product->save();
        return response()->json(
            [
                'message' => "The product has been successfully created",
                'data' => new ProductResource($product)
            ],
            200
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json(
            [
                'message' => "The data to be displayed",
                'data' => new ProductResource($product)
            ],
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->title = $request->title;
        $product->category = $request->category;
        $product->save();

        return response()->json(
            [
                'message' => "The product has been successfully updated",
                'data' => new ProductResource($product)
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(
            [
                'message' => "The product has been successfully deleted",
            ],
            200
        );
    }
}
