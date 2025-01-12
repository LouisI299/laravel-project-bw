<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'message', 'user_id'];

    // Optional: Link messages to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}