<?php

namespace App\Http\Controllers;

use App\Repositories\HomeRepository;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  HomeRepository  $homeRepository
     */
    private $homeRepo;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->middleware('auth');
        $this->homeRepo = $homeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $data = $this->homeRepo->getAdminDashboardData();

        return view('dashboard.index', compact('data'));
    }
}
