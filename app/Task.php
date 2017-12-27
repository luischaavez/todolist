<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ["task", "completed", "user_id", "project_id"];

    protected $casts = ["completed" => "boolean"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsComplete()
    {
        return $this->update([
            "completed" => true
        ]);
    }

    public function markAsIncomplete()
    {
        return $this->update([
            "completed" => false
        ]);
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
