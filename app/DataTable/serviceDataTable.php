<?php

namespace App\DataTable;

use App\Models\Service;

/**
 * Class serviceDataTable
 */
class serviceDataTable
{
    /**
     * @return Service
     */
    public function get()
    {
        /** @var Service $query */
        $query = Service::query()->select('services.*');
        
        return $query;
    }
}
