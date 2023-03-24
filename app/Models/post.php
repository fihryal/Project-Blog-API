<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'title',
        'content',
        'author',
    ];

    public function writer(): BelongsTo{
        
        return $this -> belongsTo(User::class,'author', 'id') ;
    }
    
    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
    
}