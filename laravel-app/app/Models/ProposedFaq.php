<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProposedFaq extends Model
{
    //
    protected $fillable = ['user_id', 'question', 'details', 'status'];

    /**
     * Relationship to the user who proposed the question.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}