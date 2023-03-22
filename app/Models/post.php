<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'content',
        'author',
    ];

    public function writer(): BelongsTo{
        
        return $this -> belongsTo(User::class,'author', 'id') ;
    }
    
}