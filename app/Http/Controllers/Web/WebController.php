<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\HomeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class WebController
 */
class WebController extends AppBaseController
{
    /**
     * @var HomeRepository
     */
    private $homeRepo;

    public function __construct(HomeRepository $homeRepo)
    {
        $this->homeRepo = $homeRepo;
        if (getLoggedInUser() != null) {
            $this->middleware(['role:admin', 'auth']);
        }
    }

    
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = $this->homeRepo->getHomePageData();
        $themeLayout = getSettingValue('theme_layout');
        if ($themeLayout == Setting::TEMPLATE_ONE) {
            return view('web.index')->with($data);
        } elseif ($themeLayout == Setting::TEMPLATE_TWO) {
            return view('web.portfolio')->with($data);
        } elseif ($themeLayout == Setting::TEMPLATE_THREE) {
            return view('web.new_theme_three.index')->with($data);
        } else {
            return view('web.index')->with($data);
        }
    }

    /**
     * @return Factory|View
     */
    public function showRegister()
    {
        return view('web.registration.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function registerUser()
    {
        return view('web.registration.register');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function checkUserName(Request $request)
    {
        $checkName = $request->data;
        if (User::where('user_name', '=', $checkName)->exists()) {
            return $this->sendError('User name already exists.');
        } else {
            return $this->sendSuccess('Username available.');
        }
    }
}
