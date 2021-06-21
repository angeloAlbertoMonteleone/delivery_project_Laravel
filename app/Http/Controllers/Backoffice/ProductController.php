<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Backoffice\Product;
use App\Models\Backoffice\ProductCategory;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\Product\Collection as ProductCollection;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Str;
use Arr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $trashed = $request->get('trashed', false) == true;

      $query = Product::withCount(['orders']);
      // if we dont find trashed in our querystring , give me false as default value
      if($trashed) {
        $query->onlyTrashed();
      }

      $products = $query->get();

      return response()->view('backoffice.products.index', [
        'products' => $products,
        'trashed' => $trashed
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
    public function update(UpdateProductRequest $request, Product $product)
    {

      if($request->isMethod('PUT')){
          return $this->restore($product);
      }

      $data = $request->validated();

      $product->fill([
        'title' => $data['title'],
        'slug' => Str::slug($data['title']),
        'description' => $data['description'],
        'price' => $data['price'],
        'visible' => Arr::get($data, 'visible', $product->visible)
        // $product->visible = $request->input('visible', $product->visible);
      ]);

      if($product->productCategory->id != $data['productCategory']){
        $productCategory = ProductCategory::whereSlug($data['productCategory'])->firstOrFail();
        $product->productCategory()->associate($productCategory);

      }

      $product->save();

      return \redirect()->route('products.show', ['product' => $product->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backoffice\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
      if($product->trashed()){
        $product->forceDelete();
      } else {
        $product->delete();
      }
      
      return \redirect()->route('products.index');
    }


    public function restore($product) {
      $product->restore();

      return \redirect()->route('products.show', ['product' => $product->slug]);
    }
}
