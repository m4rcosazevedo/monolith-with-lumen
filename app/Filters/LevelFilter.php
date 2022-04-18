<?php

namespace App\Filters;

use Leandreaci\Filterable\QueryFilter;

class LevelFilter extends QueryFilter
{

    public function title($title)
    {
        $this->builder->where('title', 'like', '%' . $title . '%');
    }

    public function level($level)
    {
        $this->builder->where('level', '=', $level);
    }
}
