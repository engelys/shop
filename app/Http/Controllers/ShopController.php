<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        // Fetch all products, possibly with pagination (optional)
        $products = Product::paginate(12);

        // Pass the products data to the 'shop.index' view
        return view('shop.index', compact('products'));
    }

    public function show(Product $product): View
    {
        return view('shop.products.show', compact('product'));
    }

    public function categories(): View
    {
        $categories = Category::paginate(12);

        return view('shop.categories.categories', compact('categories'));
    }

    public function category(?Category $category): View
    {
        return view('shop.categories.category', compact('category'));
    }
}
