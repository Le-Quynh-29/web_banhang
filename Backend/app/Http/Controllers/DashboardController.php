<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        abort_if(! Gate::allows('pmss--dashboard'),403);
        return response()->view('dashboard.index');
    }
}
