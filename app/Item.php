<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $guarded = [];

    public function rawIngredients() {
        return $this->belongsToMany(NotAllowedIngredientSingle::class,'item_raw_ingredient','item_id', 'ingredient_id')
            ->withPivot(['item_id', 'ingredient_id', 'ingredient_perc', 'site_location_address', 'ingredient_supplier', 'country_of_origin', 'country_where_processed']);
    }
    public function compounds() {
        return 0;
    }
}
