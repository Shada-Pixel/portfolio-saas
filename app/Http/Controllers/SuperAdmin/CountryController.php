<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use App\DataTable\CountryDataTable;
use App\Models\Education;
use App\Models\Experience;
use App\Models\State;
use App\Models\User;
use App\Repositories\CountryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CountryController extends AppBaseController
{
    /**
     * @var CountryRepository
     */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new CountryDataTable())->get())->make(true);
        }

        return view('countries.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCountryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateCountryRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['short_code'] = $input['short_code'] != null ? strtoupper($input['short_code']) : null;
        $country = $this->countryRepository->create($input);

        return $this->sendResponse($country, 'Country saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Country  $country
     *
     * @return JsonResponse
     */
    public function edit(Country $country)
    {
        return $this->sendResponse($country, 'Country successfully retrieved.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCountryRequest  $request
     *
     * @param  Country  $country
     *
     * @return JsonResponse
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $input = $request->all();
        $input['short_code'] = $input['short_code'] != null ? strtoupper($input['short_code']) : null;

        $this->countryRepository->update($input, $country->id);

        return $this->sendSuccess('Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Country  $country
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Country $country)
    {
        $countryModels = [
            Education::class, Experience::class, State::class, User::class,
        ];
        $result = canDelete($countryModels, 'country_id', $country->id);
        if ($result) {
            return $this->sendError('Country can\'t be deleted.');
        }
        $country->delete();

        return $this->sendSuccess('Country deleted successfully.');
    }
}
