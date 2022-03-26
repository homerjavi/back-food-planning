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
            'id'           => $this->id,
            'meal_id'      => $this->meal_id,
            'meal_hour_id' => $this->meal_hour_id,
            'meal_type_id' => $this->meal_type_id,
            'date'         => $this->date,
            'day_of_week'  => $this->day_of_week,
            'name'         => $meal->name ?? '',
            'category_id'  => $meal->category_id ?? '',
            'order'        => $this->order,
            'icon_path'    => $meal ? asset( $meal->category->icon->path ) : '',
            'color'        => $this->meal_type_id ? $this->mealType->color : '',
        ];
    }
}
