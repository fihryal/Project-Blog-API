<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResourc extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        
        return [
            'id' => $this -> id,
            'author' => $this -> author, 
            'title' => $this -> title,
            'image' => $this->image,
            'content' => $this -> content,
            // 'created_at' => $this -> created_at,
            'created_at' => date_format($this -> created_at, "Y/m/d H:i:s"),
        ];
    }
}