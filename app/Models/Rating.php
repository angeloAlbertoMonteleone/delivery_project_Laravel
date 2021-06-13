<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory,
    SoftDeletes;

    protected $casts = [
      'rating' => 'integer'
    ];



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
