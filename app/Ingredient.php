<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table ='ingredient';
    protected $guarded = [];

    public function compound() {
        return $this->hasMany(Ingredient::class,'ingredient_id');
    }
    public function compounds() {
        return $this->belongsToMany(NotAllowedIngredientSingle::class,'item_raw_compound','ingredient_id', 'compound_id')
            ->withPivot(['item_id', 'ingredient_id', 'compound_id', 'compound_perc', 'site_location_address', 'ingredient_supplier', 'country_of_origin', 'country_where_processed']);
    }

}
