<?php

namespace App\Filters;

use Leandreaci\Filterable\QueryFilter;

class RoleFilter extends QueryFilter
{

    public function description($description)
    {
        $this->builder->where('description', 'like', '%' . $description . '%');
    }
}
