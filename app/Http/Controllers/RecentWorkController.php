<?php

namespace App\Http\Controllers;

use App\DataTable\RecentWorkDataTable;
use App\Http\Requests\CreateRecentWorkRequest;
use App\Http\Requests\UpdateRecentWorkRequest;
use App\Models\RecentWork;
use App\Models\RecentWorkType;
use App\Repositories\RecentWorkRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\MediaStream;
use Yajra\DataTables\DataTables;

class RecentWorkController extends AppBaseController
{
    /**
     * @var RecentWorkRepository
     */
    private $recentWorkRepo;

    public function __construct(RecentWorkRepository $recentWorkRepo)
    {
        $this->recentWorkRepo = $recentWorkRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws \Exception
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new RecentWorkDataTable())->get($request->all()))->make(true);
        }
        $recentWorkTypes = RecentWorkType::orderBy('name','asc')->pluck('name', 'id');

        return view('recent_work.index', compact('recentWorkTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRecentWorkRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CreateRecentWorkRequest $request)
    {
        $input = $request->all();
        $this->recentWorkRepo->store($input);

        return $this->sendSuccess('Recent work  create successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $recentWork = RecentWork::findOrFail($id);

        return \view('recent_work.show', compact('recentWork'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $recentWork = RecentWork::findOrFail($id);
        $recentWork->load(['media', 'type']);

        return $this->sendResponse($recentWork, 'Recent work retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRecentWorkRequest  $request
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update(UpdateRecentWorkRequest $request, $id)
    {
        $input = $request->all();
        $recentWork = RecentWork::findOrFail($id);
        $this->recentWorkRepo->updateRecord($input, $recentWork);

        return $this->sendSuccess('Recent work updated successfully.');
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
        $recentWork = RecentWork::findOrFail($id);
        $recentWork->delete();

        return $this->sendSuccess('Recent work deleted successfully.');
    }

    /**
     * @param  \Spatie\MediaLibrary\MediaCollections\Models\Media  $media
     *
     * @return mixed
     */
    public function attachmentDelete(Media $media)
    {
        $media->delete();

        return $this->sendSuccess('File has been deleted successfully.');
    }

    /**
     * @param  \Spatie\MediaLibrary\MediaCollections\Models\Media  $media
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function attachmentDownload(Media $media)
    {
        $documentPath = $media->getPath();
        if (config('filesystems.default') === 'local') {
            $documentPath = (Str::after($media->getUrl(), '/uploads'));
        }

        $file = Storage::disk(config('filesystems.default'))->get($documentPath);

        $headers = [
            'Content-Type'        => $media->mime_type,
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "attachment; filename={$media->file_name}",
            'filename'            => $media->file_name,
        ];

        return response($file, 200, $headers);
    }

    /**
     * @param  int  $id
     *
     * @return MediaStream
     */
    public function allAttachmentDownload($id)
    {
        $recentWork = RecentWork::findOrFail($id);
        $downloads = $recentWork->getMedia(RecentWork::ATTACHMENT);
        if ($downloads->count()) {
            return MediaStream::create('attachments.zip')->addMedia($downloads);
        } else {
            Flash::error('No attachment available');

            return redirect()->back();
        }
    }
}
