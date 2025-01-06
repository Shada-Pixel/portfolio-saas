<?php

namespace App\DataTable;

use App\Models\SectionFive;

/**
 * Class SectionFiveDataTable
 */
class SectionFiveDataTable
{
    /**
     * @return mixed
     */
    public function get()
    {
        /** @var SectionFive $query */
        $query = SectionFive::query()->get();

        return $query;
    }
}
