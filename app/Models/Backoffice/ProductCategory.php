<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use NumberFormatter;
use App\Support\Scopes\Visible;
use App\Models\Backoffice\Product;
use App\Models\Backoffice\Restaurant;

/**
 * App\Models\Backoffice\ProductCategory
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $slug
 * @property bool $visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $products
 * @property-read int|null $products_count
 * @property-read Restaurant $restaurant
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereVisible($value)
 * @method static \Illuminate\Database\Query\Builder|ProductCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductCategory withoutTrashed()
 * @mixin \Eloquent
 */
class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $attributes = [
      'visible' => false
    ];


    protected $fillable = [
      'title',
      'description',
      'visible',

    ];


    protected $casts = [
      'visible' => 'boolean'
    ];

    // protected $with = [
    //   'products'
    // ];
  
    public function restaurant(){
      return $this->belongsTo(Restaurant::class);
    }

    public function products(){
      return $this->hasMany(Product::class);
    }

    // 1. Accessor and Mutetors




    // 2. Relations


    // 3. Scopes


    // 4.Override methods of Model class

    // 5. All methods for this model




}
