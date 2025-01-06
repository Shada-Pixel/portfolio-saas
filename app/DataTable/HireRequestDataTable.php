<?php

namespace App\DataTable;

use App\Models\HireRequest;

/**
 * Class HireMeDataTable
 */
class HireRequestDataTable
{
    /**
     * @return mixed
     */
        public function get()
        {
            return HireRequest::select('hire_requests.*');
        }
}
