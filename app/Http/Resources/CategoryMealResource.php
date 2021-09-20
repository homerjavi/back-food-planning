<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryMealResource extends JsonResource
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
            'id'             => $this->id,
            'name'           => $this->name,
            'optimum_number' => $this->optimum_number,
            'parent_id'      => $this->parent_id,
            'meals'          => MealPlanningResource::collection( $this->meals )
        ];
    }
}
