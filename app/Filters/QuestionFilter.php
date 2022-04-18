<?php

namespace App\Filters;

use Leandreaci\Filterable\QueryFilter;

class QuestionFilter extends QueryFilter
{

    public function question($question)
    {
        $this->builder->where('question', 'like', '%' . $question . '%');
    }

    public function levelId($level)
    {
        $this->builder->where('level_id', '=', $level);
    }
}
