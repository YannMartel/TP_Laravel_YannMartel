<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class criticsRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'film_id' => $this->film_id,
            'score' => $this.score,
            'comment' => $this.comment,
            'created_at' => $this.created_at,
            'updated_at' => $this.updated_at
            ];
    }
}
