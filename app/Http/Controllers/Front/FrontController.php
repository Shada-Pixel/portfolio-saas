<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCmsRequest;
use App\Models\AdminSetting;
use App\Models\FrontCms;
use App\Models\SubscriptionPlan;
use App\Repositories\FrontRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;

/**
 * Class FrontController
 */
class FrontController extends AppBaseController
{
    /**
     * @var FrontRepository
     */
    private $frontRepo;

    /**
     * @param  FrontRepository  $frontRepo
     */
    public function __construct(FrontRepository $frontRepo)
    {
        $this->frontRepo = $frontRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = $this->frontRepo->getFrontScreenData();

        return view($data['viewName'])->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UpdateCmsRequest  $request
     *
     * @return RedirectResponse
     */
    public function update(UpdateCmsRequest $request)
    {
        $input = $request->all();
        $cmsData = $this->frontRepo->updateCms($input);
        Flash::success($cmsData['message']);

        return redirect()->route($cmsData['redirect']);
    }

    // Landing screen functions

    /**
     * @return Application|Factory|View
     */
    public function showLandingScreen()
    {
        $data = $this->frontRepo->prepareLandingScreenData();

        return view('front.index')->with($data);
    }

    /**
     * @return Application|Factory|View
     */
    public function termsAndConditions()
    {
        $data = $this->frontRepo->privacyPolicyAndTermConditionsData();

        return view('front.terms_conditions.index')->with($data);
    }

    /**
     * @return Application|Factory|View
     */
    public function privacyPolicy()
    {
        $data = $this->frontRepo->privacyPolicyAndTermConditionsData();

        return view('front.privacy_policy.index')->with($data);
    }

    /**
     * @return Application|Factory|View
     */
    public function featuredPortfolio()
    {
        $data = $this->frontRepo->featuredPortfolioData();

        return view('front.portfolio.index')->with($data);
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function showMorePortfolio(Request $request)
    {
        $input = $request->all();
        $data = $this->frontRepo->showMoreFeaturedPortfolioData($input);
        $portfolios = $data['featuredPortfolios'];
        $featuredPortfolios['recordCount'] = $data['featuredPortfolios']->count();
        $featuredPortfolios['featuredPortfolios'] = view('front.portfolio.fetch_portfolio',
            compact('portfolios'))->render();

        return $this->sendResponse($featuredPortfolios, 'Recent work retrieved successfully.');
    }

    /**
     * @return Application|Factory|View
     */
    public function showPricingPlans()
    {
        $data = $this->frontRepo->getSubscriptionPlansData();

        return view('front.pricing.index')->with($data);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function paymentMethod($id)
    {

        $planMethod = SubscriptionPlan::PLAN_METHOD;
        $data = $this->frontRepo->paymentMethodData($id);

        return view('front.pricing.payment_method', compact('planMethod'))->with($data);
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function followPortfolio(Request $request)
    {
        $input = $request->all();
        $favouritePortfolio = $this->frontRepo->storeFollowPortfolio($input);
        if ($favouritePortfolio) {
            return $this->sendResponse($favouritePortfolio, 'You have followed successfully.');
        }

        return $this->sendResponse($favouritePortfolio, 'You have Unfollowed successfully.');
    }
}
