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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'club_id' => $this->club_id,
            'role_name' => optional($this->roles()->first())->name,
            'club'      => optional($this->club()->first())->name,
            'token'     => optional($this)->token
        ];
    }
}
