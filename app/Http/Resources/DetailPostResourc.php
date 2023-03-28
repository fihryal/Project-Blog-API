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
        'id_post' => $this -> id,
        'writer' => $this->whenLoaded('writer'),
        'title' => $this -> title,
        'image' => $this->image,
        'content' => $this -> content,
        'comment_total' => $this->whenLoaded('comments', function(){
            return count($this->comments);
        }),
        'comments' => $this->whenLoaded('comments', function(){
            return collect($this->comments)->each(function($comment){
                $comment->commentator;
                return $comment;
            });
        }),
            // 'created_at' => $this->created_at,
            'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
        
        'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
        ];
    }
}