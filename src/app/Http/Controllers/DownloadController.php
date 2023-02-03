<?php

namespace App\Http\Controllers;

use App\Http\Requests\Download\DownloadCreateRequest;
use App\Http\Requests\Download\DownloadDeleteRequest;
use App\Http\Requests\Download\DownloadDestroyRequest;
use App\Http\Requests\Download\DownloadEditRequest;
use App\Http\Requests\Download\DownloadIndexRequest;
use App\Http\Requests\Download\DownloadStoreRequest;
use App\Http\Requests\Download\DownloadUpdateRequest;
use App\Models\Download;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class DownloadController extends Controller
{
    public function index(DownloadIndexRequest $request): View
    {
        $downloads = Download::with('user')->latest()->get()->all();

        return view('download.index')->with(['downloads' => $downloads]);
    }

    public function create(DownloadCreateRequest $request): View
    {
        return view('download.create');
    }

    public function store(DownloadStoreRequest $request): Response
    {
        DB::beginTransaction();

        try {
            $attributes = $request->validated();

            $attributes['user_id'] = $request->user()->id;

            Download::create($attributes);

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        return redirect()->route('download.index');
    }

    public function edit(int $id, DownloadEditRequest $request): View
    {
        $download = Download::findOrFail($id);

        return view('download.edit')->with(['download' => $download]);
    }

    public function update(int $id, DownloadUpdateRequest $request): Response
    {
        $download = Download::findOrFail($id);

        DB::beginTransaction();

        try {
            $attributes = $request->validated();

            $download->update($attributes);

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        return redirect()->route('download.index');
    }

    public function delete(int $id, DownloadDeleteRequest $request): View
    {
        $download = Download::findOrFail($id);

        return view('download.delete')->with(['download' => $download]);
    }

    public function destroy(int $id, DownloadDestroyRequest $request): Response
    {
        $download = Download::findOrFail($id);

        DB::beginTransaction();

        try {
            $download->delete();

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        return redirect()->route('download.index');
    }
}
