<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IngredientResource;
use App\Ingredient;
use App\Item;
use App\NotAllowedIngredientSingle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IngredientController extends Controller
{
    public function listAll()
    {
        return IngredientResource::collection(Item::find(1)->rawIngredients);
        // return Ingredient::with('compound')->get();
    }
    public function searchIngredients(Request $request)
    {

        $query = $request->get('query');
//        return response()->json(NotAllowedIngredientSingle::select('id','name')->where('name', 'like', "%{$query}%")->take(10)->get(),200);
        return response()->json(NotAllowedIngredientSingle::select('id','name')->where('name', 'like', "%{$query}%")->take(10)->get(),200);
        // return Ingredient::with('compound')->get();
    }
    public function save(Request $request)
    {
        //update

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

        foreach ($cmp as $compound) {
            $toSync = new NotAllowedIngredientSingle();
            $toSync->name = $compound['name'];
            $toSync->save();

            $toRetCompounds[$toSync->id] = [
                'compound_perc'     => $compound['perc'],
                'item_id'           => $item->id
            ];
        }
        if (isset($toRetCompounds))
            $ing->compounds()->sync($toRetCompounds);




        return response()->json('Done!', 200);
    }
    public function delete()
    {
        $item = Item::find(1);
        $ing = NotAllowedIngredientSingle::find(request()->id);

        $ing->compounds()->detach();
        $item->rawIngredients()->detach($ing);

        return response()->json(request()->id, 200);
    }
    public function updateField(Request $request) {

        $item = Item::find(request()->data['item_id']);
        $ingId = request()->data['ingredient_id'];
        $field = request()->data['field'];
        $value = request()->data['value'];
        $compound = request()->data['compound'];


        $ing = $item->rawIngredients()->where('ingredient_id',$ingId)->first();

        if(!$compound)
            $ing->pivot->update([$field => $value]);
        else {
            $cmp = $ing->compounds->where('id',$compound)->first();
            $cmp->pivot->update([$field => $value]);
        }

        return response()->json('Ok',200);
    }
}
