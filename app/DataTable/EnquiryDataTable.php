<?php

namespace App\DataTable;

use App\Models\AdminEnquiry;
use App\Models\Enquiry;
use Illuminate\Database\Query\Builder;

/**
 * Class EnquiryDataTable.
 */
class EnquiryDataTable
{
    /**
     * @param  array  $input
     *
     * @return Enquiry|Builder
     */
    public function get($input = [])
    {
        if (getLoggedInUser()->hasRole('super_admin')) {
            /** @var Enquiry $query */
            $query = AdminEnquiry::select('admin_enquiries.*');

            $query->when(isset($input['status']) && $input['status'] != AdminEnquiry::ALL,
                function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                    $q->where('status', '=', $input['status']);
                });

            return $query;
        } else {
            /** @var Enquiry $query */
            $query = Enquiry::select('enquiries.*');

            $query->when(isset($input['status']) && $input['status'] != Enquiry::ALL,
                function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                    $q->where('status', '=', $input['status']);
                });

            return $query;
        }
    }
}
