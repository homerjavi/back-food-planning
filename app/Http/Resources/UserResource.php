<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email'          => $this->email,
            'email_verified' => $this->email_verified,
            'account_id'     => $this->account_id,
            'account_name'   => $this->account->name,
            'avatar_src'     => asset( $this->avatar_path ),
        ];
    }
}
