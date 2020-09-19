<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IngredientResource;
use App\Ingredient;
use App\Item;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function listAll() {
        return IngredientResource::collection(Item::find(1)->rawIngredients);
        // return Ingredient::with('compound')->get();
    }
}
