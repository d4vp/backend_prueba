<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'status', 'priority'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, User $user)
    {
        // Un admin ve todo; un usuario estándar solo lo suyo.
        return $user->isAdmin() ? $query : $query->where('user_id', $user->id);
    }
}
