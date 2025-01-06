<?php

namespace App\Http\Controllers;

use App\DataTable\EnquiryDataTable;
use App\Http\Requests\CreateEnquiryRequest;
use App\Mail\EnquirySend;
use App\Models\AdminEnquiry;
use App\Models\Enquiry;
use App\Repositories\EnquiryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\Facades\DataTables;

class EnquiryController extends AppBaseController
{
    /** @var  EnquiryRepository */
    private $enquiryRepository;

    public function __construct(EnquiryRepository $enqRepo)
    {
        $this->enquiryRepository = $enqRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new EnquiryDataTable())->get($request->only(['status'])))->make(true);
        }
        if (getLoggedInUser()->hasRole('super_admin')) {
            $data['statusArr'] = AdminEnquiry::STATUS_ARR;
        } else {
            $data['statusArr'] = Enquiry::STATUS_ARR;
        }

        return view('enquiries.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEnquiryRequest  $request
     *
     * @return RedirectResponse|mixed
     */
    public function store(CreateEnquiryRequest $request)
    {
        $to = null;
        $data = null;
        $input = $request->all();
        $input['phone'] = preparePhoneNumber($input['phone'], $input['region_code']);
        try {
            if (getUser() == null || getUser()->hasRole('super_admin')) {
                $superAdminEnquiry = AdminEnquiry::create($input);
                $to = getAdminSettingValue('contact_email');
                $data = [
                    'name'    => $superAdminEnquiry->full_name,
                    'email'   => $superAdminEnquiry->email,
                    'message' => $superAdminEnquiry->message,
                ];
            } else {
                $input['tenant_id'] = getUser()->tenant_id;
                $enquiry = new Enquiry();
                $enquiry->first_name = $input['first_name'];
                $enquiry->last_name = $input['last_name'];
                $enquiry->email = $input['email'];
                $enquiry->phone = $input['phone'];
                $enquiry->region_code = isset($input['phone']) ? $input['region_code'] : getAdminSettingValue('default_region_code');
                $enquiry->message = $input['message'];
                $enquiry->tenant_id = $input['tenant_id'];
                $enquiry->save();
                $enquiry = Enquiry::find($enquiry->id);

                $to = getUser()->email;
                $data = [
                    'name'    => $enquiry->full_name,
                    'email'   => $enquiry->email,
                    'message' => $enquiry->message,
                ];
            }

            Mail::to($to)->send(new EnquirySend($data));

            return $this->sendSuccess('Enquiry send successfully.');
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        if (getLoggedInUser()->hasRole('super_admin')) {
            $enquiry = AdminEnquiry::findOrFail($id);
        } else {
            $enquiry = Enquiry::findOrFail($id);
        }

        if ($enquiry->status == 0) {
            $enquiry->update(['status' => 1]);
        }

        return view('enquiries.show', compact('enquiry'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (getLoggedInUser()->hasRole('super_admin')) {
            $enquiry = AdminEnquiry::findOrFail($id);
        } else {
            $enquiry = Enquiry::findOrFail($id);
        }

        $enquiry->delete();

        return $this->sendSuccess('Enquiry deleted successfully.');
    }
}
