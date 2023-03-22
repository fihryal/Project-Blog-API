<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailPostResourc extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return[
        'id' => $this -> id,
        'title' => $this -> title,
        'content' => $this -> content,
        'author' => $this -> author,
        
        'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
        ];
    }
}