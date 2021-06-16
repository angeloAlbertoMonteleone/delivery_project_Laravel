<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use NumberFormatter;
use App\Support\Scopes\Visible;
use App\Models\User;
use App\Models\Backoffice\ProductCategory;
use App\Models\Rating;
use App\Models\Order;

/**
 * App\Models\Backoffice\Restaurant
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Order[] $orders
 * @property-read int|null $orders_count
 * @property-read User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $productCategories
 * @property-read int|null $product_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Rating[] $ratings
 * @property-read int|null $ratings_count
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant newQuery()
 * @method static \Illuminate\Database\Query\Builder|Restaurant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Restaurant whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Restaurant withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Restaurant withoutTrashed()
 * @mixin \Eloquent
 */
class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $attributes = [
    ];


    protected $fillable = [
      'title',
      'description',
      'slug',
    ];


    protected $casts = [];

    public function owner(){
      return $this->belongsTo(User::class, 'user_id');
    }

    public function productCategories() {
      return $this->hasMany(ProductCategory::class);
    }

    public function orders() {
      return $this->hasMany(Order::class);
    }

    public function ratings() {
      return $this->hasMany(Rating::class);
    }
    // 1. Accessor and Mutetors


    // 2. Relations

    // 3. Scopes


    // 4.Override methods of Model class

    // 5. All methods for this model


}
