<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:20',
            'shortDescription' => 'required|string|max:200',
            'detailedDescription' => 'required|string|max:500',
            'img' => 'required|image|mimes:png,jpg|max:2048',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'rate' => 'numeric',
        ]);

        // Store the image and get the path
        $imagePath = $request->file('img')->store('public/products');
        $data['image'] = $imagePath;

        Product::create($data);

        return response()->json([
            'success' => 'Product created successfully'
        ]);
    }

    public function index()
    {
        $products = Product::select('id', 'name', 'image', 'shortDescription', 'price')
                            ->orderBy('id', 'asc')
                            ->paginate(10);

        return new ProductCollection($products);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
