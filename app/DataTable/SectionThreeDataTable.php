<?php

namespace App\DataTable;

use App\Models\SectionThree;

/**
 * Class SectionThreeDataTable
 */
class SectionThreeDataTable
{
    /**
     * @return mixed
     */
    public function get()
    {
        /** @var SectionThree $query */
        $query = SectionThree::query()->get();

        return $query;
    }
}
