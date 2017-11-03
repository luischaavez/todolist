<?php

namespace App\Filters;

use Carbon\Carbon;

class TasksFilters extends Filters
{
    protected $filters = ["completed", "today", "week"];

    public function completed($value)
    {
        return $this->builder->where("completed", (boolean) $value);
    }

    public function today()
    {
        return $this->builder->whereDate("created_at", Carbon::now()->toDateString());
    }

    public function week()
    {
        return $this->builder->whereDate("created_at", ">=", Carbon::now()->startOfWeek()->toDateString())
            ->whereDate("created_at", "<=", Carbon::now()->endOfWeek()->toDateString());
    }
}