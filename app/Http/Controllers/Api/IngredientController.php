<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IngredientResource;
use App\Ingredient;
use App\Item;
use App\NotAllowedIngredientSingle;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function listAll() {
        return IngredientResource::collection(Item::find(1)->rawIngredients);
        // return Ingredient::with('compound')->get();
    }
    public function save(Request $request) {
        $item = Item::find(1);
        $data = request()->data;
        $cmp = $data['compounds'];

        $ing = new NotAllowedIngredientSingle();
        $ing->name = $data['ingredient']['name'];
        $ing->save();

        $toRet[$ing->id] = [
            'ingredient_perc' => $data['ingredient']['perc']
        ];

        $item->rawIngredients()->attach($toRet);


        foreach($cmp as $compound) {
            $toSync = new NotAllowedIngredientSingle();
            $toSync->name = $compound['name'];
            $toSync->save();

            $toRetCompounds[$toSync->id] = [
                'compound_perc'     => $compound['perc'],
                'item_id'           => $item->id
            ];
        }
        $ing->compounds()->sync($toRetCompounds);




        return response()->json('Done!', 200);
    }
}
