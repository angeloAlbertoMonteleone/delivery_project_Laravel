<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'updated_date';

    protected $attributes = [
      'title' => 'Nuovo ruolo'
    ];

    protected $fillable = [
      'name',
      'description'
    ];


    protected $hidden = [

    ];

    protected $visible = [

    ];

    protected $casts = [

    ];


}
