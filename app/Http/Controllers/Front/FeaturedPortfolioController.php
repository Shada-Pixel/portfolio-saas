<?php

namespace App\Http\Controllers\Front;

use App\DataTable\FeaturedPortfolioDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FeaturedPortfolioController extends AppBaseController
{
    /**
     * @param  Request  $request
     *
     * @throws \Exception
     *
     * @return View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new FeaturedPortfolioDataTable())->get($request->only(['is_portfolio_featured'])))->make(true);
        }

        $isPortfolioFeatured = User::FEATURED_PORTFOLIO;

        return view('front.featured_portfolio.index', compact('isPortfolioFeatured'));
    }

    /**
     * @param  Request  $request
     * @param  User  $user
     * @return mixed
     */
    public function changePortfolioFeatured(Request $request, User $user)
    {
        $isPortfolioFeatured = $request->get('is_portfolio_featured');
        DB::table('users')->where('id', $user->id)->update(['is_portfolio_featured' => $isPortfolioFeatured]);

        return $this->sendSuccess('Featured Portfolio updated successfully.');
    }
}
