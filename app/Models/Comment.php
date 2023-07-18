<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tweet_id',
        'body',
    ];

    /**
     * Get the user that wrote the Comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tweet that the Comment belongs to.
     */
    public function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class);
    }
}
