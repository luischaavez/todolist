<?php

namespace App\Filters;

use Carbon\Carbon;

class TasksFilters extends Filters
{
    protected $filters = ["completed", "today", "week", "project"];

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

    public function project($id)
    {
        return $this->builder->where("project_id", $id);
    }
}