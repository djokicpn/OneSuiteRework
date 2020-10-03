<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'item_id' => $this->pivot->item_id,
            'perc' => $this->pivot->ingredient_perc,
            'compound_perc' => $this->pivot->compound_perc,
            'name' => $this->name,
            'location' => $this->pivot->site_location_address,
            'supplier'=> $this->pivot->ingredient_supplier,
            'origin_country'=> $this->pivot->country_of_origin,
            'processed_country'=> $this->pivot->country_where_processed,
            'compound' => IngredientResource::collection($this->compounds),
            'created_at' => $this->created_at->toDateString()
        ];
    }
}
// {
//     "id": 831,
//     "name": "Baby Corn",
//     "number": null,
//     "level_id": null,
//     "class_id": 5,
//     "created_at": "2020-09-19T14:33:19.000000Z",
//     "updated_at": "2020-09-19T14:33:19.000000Z",
//     "pivot": {
//         "item_id": 1,
//         "ingredient_id": 831,
//         "ingredient_perc": 15,
//         "site_location_address": null,
//         "ingredient_supplier": null,
//         "country_of_origin": null,
//         "country_where_processed": null
//     }
// },
