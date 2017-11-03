<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $builder;

    protected $request;

    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->setRequest($request);
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach($this->filters() as $filter => $value) {
            if(method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->only($this->filters);
    }

    protected function setRequest(Request $request)
    {
        if(! $request->has("completed")) {
            $request->merge(["completed" => false]);
        }

        $this->request = $request;
    }
}