<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'difficulty' => $this->difficulty,
            'minutes'    => $this->minutes,
            'kalories'   => $this->kalories,
            'recipe'     => $this->recipe,
        ];
    }
}
