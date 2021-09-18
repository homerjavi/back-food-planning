<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealPlanningResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => null,
            'date'        => null,
            'day_of_week' => null,
            'hour'        => null,
            'type'        => null,
            'meal_id'     => $this->id,
            'name'        => $this->name,
            'category_id' => $this->category_id,
            'order'       => null,
        ];
    }
}
