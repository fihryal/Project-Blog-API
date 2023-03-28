<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class commentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
            return[
                'id' => $this->id,
                'comments_content' => $this->comments_content,
                'user_id'=> $this->user_id,
                'commentator' => $this->whenLoaded('commentator'),
                'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
            ];
            return parent::toArray($request);
        }

    
}