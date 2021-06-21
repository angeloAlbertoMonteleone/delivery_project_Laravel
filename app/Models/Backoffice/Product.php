<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use NumberFormatter;
use App\Support\Scopes\Visible;
use App\Models\Backoffice\ProductCategory;
use App\Models\Order;

/**
 * App\Models\Backoffice\Product
 *
 * @property int $id
 * @property int $product_category_id
 * @property string $title
 * @property string|null $description
 * @property string $slug
 * @property bool $visible
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Order[] $orders
 * @property-read int|null $orders_count
 * @property-read ProductCategory $productCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product onlyInvisible()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVisible($value)
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $attributes = [
      'visible' => false
    ];


    protected $fillable = [
      'title',
      'description',
      'slug',
      'visible',
      'price'
    ];


    protected $casts = [
      'visible' => 'boolean',
      'price' => 'decimal:2'
    ];


    protected $with = [
      'productCategory'
    ];

    // 1. Accessor and Mutetors

    //Defining an Accessor - if I have to show the product in some way
    public function getPriceAttribute(float $value):string
    {
      $ftm = new NumberFormatter('it_it', NumberFormatter::CURRENCY);

      return $ftm->formatCurrency($value, 'EUR');
    }

    // Defining A Mutator - when I have to set up some rules
    public function setPriceAttribute($value)
    {
      if($value < 0) {
        $value = $value * -1;
      }

      $this->attributes['price'] = round($value, 2);
    }



    // 2. Relations

    public function productCategory() {
      return $this->belongsTo(ProductCategory::class);
    }


    public function orders() {
      return $this->belongsToMany(Order::class);
    }

    // 3. Scopes

    public function scopeOnlyInvisible($query):Builder {
      // static::withoutGlobalScope(Visible::class);

      return $query->where('visible', '=', false);
    }

    // 4.Override methods of Model class

    // 5. All methods for this model
    public static function booted() {
      static::addGlobalScope(new Visible());
    }





    // retrieve the model for a bound value
    public function resolveRouteBinding($value, $field = null) {
      //
      // if(\request()->isMethod('PUT') && \request()->route()->named()->named('product.udpate')
      // || request()->route()->named('product.destroy')) {
      //   $this->onlyTrashed();
      // }


      if(is_numeric($value)){
        // if you are admin and you are passing an id, you can see the trashed products
        return $this->withTrashed()->findOrFail($value);
      }

      return $this->where('slug', '=', $value)->firstOrFail();
    }


    public function getPureFloatPrice() {
      return $this->attributes['price'];
    }
}
