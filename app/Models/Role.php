<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \datetime|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Query\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Role withoutTrashed()
 * @mixin \Eloquent
 */
class Role extends Model
{
    use HasFactory, softDeletes;

    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'updated_date';

    protected $attributes = [
    ];

    protected $fillable = [
      'title',
      'description'
    ];


    protected $hidden = [

    ];

    protected $visible = [
      'title',
      'description',
      'created_at',
      'deleted_at'
    ];

    protected $casts = [
      'created_at' => 'datetime:d/m/Y'
    ];

    public function users() {
      return $this->hasMany(User::class);
    }

}
