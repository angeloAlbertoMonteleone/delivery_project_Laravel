<?php

namespace App\Http\Resources\Backoffice\ProductCategory;
use App\Models\Backoffice\ProductCategory;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ProductCategory;
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
      return [
        ['title' => $this->title,
        // 'productCategory' => $this->when($this->relationLoaded('productCategory'), $this->productCategory->title)
        'slug' => $this->slug
        ]
      ];
    }
}
