<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Backoffice\Product;
use App\Models\Backoffice\ProductCategory;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\Product\Collection as ProductCollection;
use App\Http\Requests\StoreProductRequest;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $products = Product::with(['productCategory'])->withCount(['orders'])->get();

      return response()->view('backoffice.products.index', [
        'products' => $products
      ]);

      // if we wanna create a json file for frontend
      // return new ProductCollection($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $productCategories = ProductCategory::whereVisible(true)->get();
      return response()->view('backoffice.products.create', \compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
      $data = $request->validated();

      $product = new Product([
        'title' => $data['title'],
        'slug' => Str::slug($data['title']),
        'description' => $data['description'],
        'price' => $data['price'],
        'visible' => true,
      ]);

      $productCategory = ProductCategory::whereSlug($data['productCategory'])->firstOrFail();

      $product->productCategory()->associate($productCategory);
      $product->save();

      return \redirect()->route('products.show', ['product' => $product->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backoffice\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

      return response()->view('backoffice.products.show',[
        'product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backoffice\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
      $productCategories = ProductCategory::get();

      return response()->view('backoffice.products.edit', [
        'productCategories' => $productCategories,
        'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backoffice\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backoffice\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
