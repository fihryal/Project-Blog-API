<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'post_id',
        'user_id',
        'comments_content'
    ];

    public function commentator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key','id');
    }
}