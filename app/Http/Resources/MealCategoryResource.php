<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'category'    => $this->category ? new CategoryResource( $this->category ) : [],
            'difficulty'  => $this->difficulty,
            'minutes'     => $this->minutes,
            'kalories'    => $this->kalories,
            'recipe'      => $this->recipe,
            'description' => $this->description,
        ];
    }
}
