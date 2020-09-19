<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotAllowedIngredientSingle extends Model
{
    protected $table = 'customer_not_allowed_ingredients_single';

    protected $guarded = [];

    public function item()
    {
        return $this->belongsToMany(Item::class, 'customer_not_allowed_ingredients_items','not_allowed_ingredient_id','item_id');
    }

    public function rawItems() {
        return $this->belongsToMany(Item::class,'item_raw_ingredient','ingredient_id', 'item_id')
            ->withPivot(['item_id', 'ingredient_id', 'ingredient_perc', 'site_location_address', 'ingredient_supplier', 'country_of_origin', 'country_where_processed']);
    }

    public function compounds() {
        return $this->belongsToMany(NotAllowedIngredientSingle::class,'item_raw_compound','ingredient_id', 'compound_id')
            ->withPivot(['item_id', 'ingredient_id', 'compound_id', 'compound_perc', 'site_location_address', 'ingredient_supplier', 'country_of_origin', 'country_where_processed']);
    }

    public function ingredientClass()
    {
        return $this->belongsTo(NotAllowedIngredientClass::class, 'class_id');
    }

}
