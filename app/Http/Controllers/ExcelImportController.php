<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExcelFileRequest;
use App\Jobs\ParseRowsJob;
use Illuminate\Support\Facades\Redis;

class ExcelImportController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        return view('excelImport');
    }

    public function importFile(ExcelFileRequest $request)
    {
        $file = $request->file('file');
        $path = $file->store('import');

        Redis::set($path, 1);

        ParseRowsJob::dispatch($path)->onQueue('high');

        return redirect('/');
    }
}
