<?php 

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Shop\Traits\HasProduc as ShopHasProduct; // Fixed typo in trait import
use Illuminate\Http\Request;

class ProductController extends Controller{
    use ShopHasProduct; // Import the corrected trait

    /**
     * Display all of the products
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        // Fetch all products organized by category
        $all = $this->organizeProductsByCategory($request);

        // Return the view with the products
        return view('frontend.shop', compact('all'));
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product){
        // Return the view with the product
        return view('frontend.single-product', compact('product'));
    }
}