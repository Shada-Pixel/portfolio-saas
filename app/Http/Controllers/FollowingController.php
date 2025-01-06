<?php

namespace App\Http\Controllers;

use App\DataTable\FollowingDataTable;
use App\Models\FavoritePortfolio;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FollowingController extends AppBaseController
{
    /**
     * @throws \Exception
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            return DataTables::of((new FollowingDataTable())->get())->make(true);
        }

        return view('following.index');
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function unfollowUser(Request $request)
    {
        $id = $request->get('id');
        FavoritePortfolio::where('follower_id', $id)
            ->where('following_id', getLoggedInUserId())
            ->delete();

        return $this->sendSuccess('Unfollowed user Successfully.');
    }
}
