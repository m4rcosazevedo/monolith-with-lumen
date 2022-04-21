<?php

namespace App\Filters;

use Leandreaci\Filterable\QueryFilter;

class PermissionFilter extends QueryFilter
{

    public function description($description)
    {
        $this->builder->where('description', 'like', '%' . $description . '%');
    }

    public function permission($description)
    {
        $this->builder->where('permission', 'like', '%' . $description . '%');
    }
}
