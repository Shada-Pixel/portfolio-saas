<?php

namespace App\DataTable;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UsersDataTable
 */
class FeaturedPortfolioDataTable
{
    /**
     * @param  array  $input
     *
     * @return User
     */
    public function get($input = [])
    {

        /**
         * @var User $query
         */
        $query = User::with(['media', 'roles'])->whereNotNull('email_verified_at')->where('status',
            User::ACTIVE)->whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->select('users.*');


        // filter for status
        $query->when(isset($input['is_portfolio_featured']) && $input['is_portfolio_featured'] != '',
            function (Builder $q) use ($input) {
                $q->where('is_portfolio_featured', $input['is_portfolio_featured']);
            });

        return $query;
    }
}
