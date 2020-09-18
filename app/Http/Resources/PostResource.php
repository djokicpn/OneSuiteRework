<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $cat = $this->category;
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'post_text' => $this->post_text,
            'created_at' => $this->created_at->toDateString(),
            'category' =>
                [
                    'id' => $cat->id,
                    'name' => $cat->name
                ],
            'type' => 0
        ];
    }
}
