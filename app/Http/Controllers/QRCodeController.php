<?php

namespace App\Http\Controllers;

use App\DataTable\QRCodeDataTable;
use App\Http\Requests\CreateQRCodeRequest;
use App\Http\Requests\UpdateQRCodeRequest;
use App\Models\QRCode;
use App\Repositories\QRCodeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class QRCodeController extends AppBaseController
{
    /**
     * @var QRCodeRepository
     */
    private $QRCodeRepo;

    public function __construct(QRCodeRepository $QRCodeRepo)
    {
        $this->QRCodeRepo = $QRCodeRepo;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @throws \Exception
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new QRCodeDataTable())->get())->make(true);
        }

        return view('qrcode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $style = QRCode::STYLE;
        $eyeStyle = QRCode::EYE_STYLE;

        return view('qrcode.create', compact('style', 'eyeStyle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateQRCodeRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateQRCodeRequest $request)
    {
        $input = $request->all();

        QRCode::create($input);

        Flash::success('QRCode created successfully.');

        return redirect()->route('qrcodes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qrCode = QRCode::findOrFail($id);
        $qrCodeImage = $this->QRCodeRepo->qrCodeShow($qrCode);

        return $this->sendResponse(utf8_encode($qrCodeImage), 'QRCode retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $style = QRCode::STYLE;
        $eyeStyle = QRCode::EYE_STYLE;
        $qrCode = QRCode::findOrFail($id);

        return view('qrcode.edit', compact('qrCode', 'style', 'eyeStyle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateQRCodeRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateQRCodeRequest $request, $id)
    {
        $input = $request->all();
        $qrCode = QRCode::findOrFail($id);

        $qrCode->update($input);

        Flash::success('QRCode updated successfully.');

        return redirect()->route('qrcodes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qrCode = QRCode::findOrFail($id);
        $qrCode->delete();

        return $this->sendSuccess('QRCode deleted successfully.');
    }


    /**
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function QRCodeGenerator(Request $request)
    {
        $input = $request->all();
        $qrCode = $this->QRCodeRepo->generate($input);

        return $this->sendResponse(utf8_encode($qrCode), 'QRCode generated successfully.');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function qrCodeDownload($id)
    {
        $qrCode = QRCode::findOrFail($id);
        $qrCodeImage = $this->QRCodeRepo->qrCodeDownload($qrCode);

        return $this->sendResponse(utf8_encode($qrCodeImage), 'QRCode Download successfully.');
    }
}
