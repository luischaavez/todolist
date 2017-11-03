<?php

namespace App\Filters;

class TasksFilters extends Filters
{
    protected $filters = ["completed"];

    public function completed($value)
    {
        return $this->builder->where("completed", true);
    }
}