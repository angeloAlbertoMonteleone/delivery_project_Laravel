<?php

namespace App\Support\Scopes;

use Illuminate\Database\Eloquent\Scope;

/**
 *
 */
class Visible implements Scope
{

  public function apply($builder, $model) {
    $builder->where('visible', '=' , true);
  }
}
