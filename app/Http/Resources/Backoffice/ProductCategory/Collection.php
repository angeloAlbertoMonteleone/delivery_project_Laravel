<?php

namespace App\Http\Resources\Backoffice\ProductCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Backoffice\ProductCategory\Model as ProductCategoryResource;

class Collection extends ResourceCollection
{
  /**
   * Transform the resource collection into an array.
   *
   * @return array
   */
  public $collects = ProductCategoryResource::class; 
}
