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

}
