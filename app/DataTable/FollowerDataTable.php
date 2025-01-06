<?php

namespace App\DataTable;

use App\Models\FavoritePortfolio;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FollowerDataTable
 */
class FollowerDataTable
{
    /**
     * @return FavoritePortfolio
     */
    public function get()
    {
        /** @var FavoritePortfolio $query */
        $query = FavoritePortfolio::with('users')->where('following_id', '!=',
            getLoggedInUserId())->where('follower_id', getLoggedInUserId())->select('favorite_portfolios.*');


        return $query;
    }
}
