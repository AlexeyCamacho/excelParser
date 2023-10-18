<?php

namespace App\Http\Controllers;

use App\Models\Row;
use Illuminate\Http\Request;

class ShowRowsController extends Controller
{
    public function show()
    {
        $rows = Row::orderBy('date', 'desc')
            ->groupBy('date')
            ->selectRaw('GROUP_CONCAT(name) as "names", GROUP_CONCAT(row_id) as "IDs", `date`')
            ->get();

        return $rows->groupBy('date');
    }
}
