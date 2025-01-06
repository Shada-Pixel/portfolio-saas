<?php

namespace App\Http\Controllers;

use App\DataTable\FollowerDataTable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FollowerController extends AppBaseController
{
    /**
     * @throws \Exception
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            return Datatables::of((new FollowerDataTable())->get())->make(true);
        }

        return view('followers.index');
    }
}
