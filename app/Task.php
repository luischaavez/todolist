<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ["task", "completed", "user_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOf($query, $user)
    {
        return $query->where("user_id", $user->id);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
