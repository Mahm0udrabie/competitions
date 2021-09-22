<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubResource extends JsonResource
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
            'id'=> $this->id,
            'name' => $this->name,
            'username' => optional($this->user)->name,
            'competition' => optional($this->competition)->name,
            'user_id' => $this->user_id,
            'status' => $this->status
        ];
    }
}
