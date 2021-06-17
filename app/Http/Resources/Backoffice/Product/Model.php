<?php

namespace App\Http\Resources\Backoffice\Product;
use App\Models\Backoffice\Product;
use App\Http\Resources\Backoffice\ProductCategory\Model as ProductCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product;
 **/

class Model extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

      if($request->route()->named('products.show')) {
        return [
          'title' => $this->title,
          'description' =>$this->description,
          'updateRoute' => [
            'url' => route('products.update', ['product' => $this->slug]),
            'method' => 'PATCH'
          ]
        ];
      }
        return [
          ['title' => $this->title,
          'url' => route('products.show', ['product' => $this->slug]),
        // 'productCategory' => $this->when($this->relationLoaded('productCategory'), $this->productCategory->title) ]
        'productCategory' => new ProductCategoryResource($this->whenLoaded('productCategory'))
      ]
        ];
    }
}
