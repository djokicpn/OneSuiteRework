<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotAllowedIngredientClass extends Model
{
    protected $table = 'customer_not_allowed_ingredients_class';
    protected $guarded = [];

    public function ingredients()
    {
        return $this->hasMany(NotAllowedIngredientSingle::class);
    }
}
