<?php

namespace App\DataTable;

use App\Models\FavoritePortfolio;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FollowingDataTable
 */
class FollowingDataTable
{
    /**
     * @return FavoritePortfolio
     */
    public function get()
    {
        /** @var FavoritePortfolio $query */
        $query = FavoritePortfolio::with('user')->where('follower_id', '!=',
            getLoggedInUserId())->where('following_id', getLoggedInUserId())->select('favorite_portfolios.*');
        return $query;
    }

}
