<?php

namespace App\Http\Resources;

use App\Models\Meal;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $meal = Meal::find( $this->meal_id );
        return [
            'id'          => $this->id,
            'date'        => $this->date,
            'day_of_week' => $this->day_of_week,
            'hour'        => $this->hour,
            'type'        => $this->type,
            'meal_id'     => $this->meal_id,
            'name'        => $meal->name,
            'category_id' => $meal->category_id,
            'order'       => $this->order,
        ];
    }
}
