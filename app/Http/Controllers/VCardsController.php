<?php

namespace App\Http\Controllers;

use App\DataTable\vCardsDataTable;
use App\Http\Requests\CreateVCardRequest;
use App\Http\Requests\UpdateVCardRequest;
use App\Models\Service;
use App\Models\User;
use App\Models\VCard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\VCardRepository;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class VCardsController extends AppBaseController
{
    /**
     * @var VCardRepository
     */
    private $vCardRepo;

    /**
     * @param  VCardRepository  $VCardRepository
     */
    public function __construct(VCardRepository $VCardRepository)
    {
        $this->vCardRepo = $VCardRepository; 
    }

    /**
     * Display a listing of the resource.
     * @param  Request  $request
     * @throw Exception
     * @throws \Exception
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new vCardsDataTable())->get())->make(true);
        }   
        
        return view('vcards.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('vcards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateVCardRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateVCardRequest $request)
    {
        $input = $request->all();

        $this->vCardRepo->store($input);

        Flash::success('VCard created successfully.');

        return redirect()->route('vcards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $vCard = VCard::with(['vCardAttributes'])->findOrFail($id);
        $user = User::with('media')->where('tenant_id', $vCard->tenant_id)->first();

        return view('vcards.show', compact('vCard', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $vCards = VCard::with(['vCardAttributes'])->findOrFail($id);
        $user = User::with('media')->where('tenant_id', $vCards->tenant_id)->first();
        $iconColor = [];
        foreach ($vCards->vCardAttributes as $key => $value) {
            $iconColor[] = $value->icon_color;
        }

        return view('vcards.edit', compact('vCards', 'iconColor', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateVCardRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateVCardRequest $request, $id)
    {
        $input = $request->all();

        $VCard = VCard::findOrFail($id);
        $VCARD = $this->vCardRepo->editRecord($input, $VCard);

        Flash::success('VCard updated successfully.');

        return redirect()->route('vcards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $vCard = VCard::findOrFail($id);
        $vCard->delete();

        return $this->sendSuccess('vCard deleted successfully.');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function vCardsTemplate($uniqueId)
    {
        $vcard = VCard::with('vCardAttributes')->where('v_card_unique_id', $uniqueId)->first();
        $data = $this->vCardRepo->getHomePageData($vcard);

        return view(VCard::TEMPLATE[$vcard->template_id], compact('vcard', 'data'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function vCardsServiceDetails($id)
    {
        $service = Service::findOrFail($id);

        return $this->sendResponse($service, 'Service retrieved successfully.');
    }
}
