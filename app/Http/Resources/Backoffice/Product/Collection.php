<?php

namespace App\Http\Resources\Backoffice\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Backoffice\Product\Model as ProductResource;


class Collection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array
     */
    public $collects = ProductResource::class; 

}
