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
}
