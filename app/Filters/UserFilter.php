<?php

namespace App\Filters;

use Leandreaci\Filterable\QueryFilter;

class UserFilter extends QueryFilter
{

    public function name($name)
    {
        $this->builder->where('name', 'like', '%' . $name . '%');
    }
}
