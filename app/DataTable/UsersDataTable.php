<?php

namespace App\DataTable;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UsersDataTable
 */
class UsersDataTable
{
    /**
     * @param  array  $input
     *
     * @return User
     */
    public function get($input = [])
    {
        
        /** @var User $query */
        $query = User::with(['media', 'roles'])->select('users.*');

        // filter for status
        $query->when(isset($input['status']) && $input['status'] != '',
            function (Builder $q) use ($input) {
                $q->where('status', $input['status']);
            });
        $query->when(isset($input['available_as_freelancer']) && $input['available_as_freelancer'] != '',
            function (Builder $q) use ($input) {
                $q->where('available_as_freelancer', $input['available_as_freelancer']);
            });
        
        return $query;
    }
}
