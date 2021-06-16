<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backoffice\Restaurant;

/**
 * App\Models\Rating
 *
 * @property int $id
 * @property int $restaurant_id
 * @property int $rating
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Restaurant $restaurant
 * @method static \Illuminate\Database\Eloquent\Builder|Rating bad()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating currentMonthVeryBad()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating good()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating notTooBad()
 * @method static \Illuminate\Database\Query\Builder|Rating onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating veryBad()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating veryGood()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Rating withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Rating withoutTrashed()
 * @mixin \Eloquent
 */
class Rating extends Model
{
    use HasFactory,
    SoftDeletes;

    protected $casts = [
      'rating' => 'integer'
    ];


    public function restaurant(){
      return $this->belongsTo(Restaurant::class);
    }

    /**
    * Scope a query to only include popular users.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function scopeVeryBad($query):Builder
   {
       return $query->whereRating(1);
   }

   /**
    * Scope a query to only include active users.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function scopeCurrentMonthVeryBad($query):Builder
   {
       return $query->whereRating(1)->where('created_at', '>=', Carbon::now()->startOfMonth());
   }

   /**
    * Scope a query to only include popular users.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function scopeBad($query):Builder
   {
       return $query->whereRating(2);
   }


   /**
    * Scope a query to only include active users.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function scopeNotTooBad($query):Builder
   {
       return $query->whereRating(3);
   }


   /**
    * Scope a query to only include active users.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function scopeGood($query):Builder
   {
       return $query->whereRating(4);
   }



   /**
    * Scope a query to only include active users.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function scopeVeryGood($query):Builder
   {
       return $query->whereRating(5);
   }
}
