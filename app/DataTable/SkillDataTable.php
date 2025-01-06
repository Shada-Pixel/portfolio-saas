<?php

namespace App\DataTable;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SkillDataTable
 */
class SkillDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        $query = Skill::toBase();
        
        return $query;
    }
}
