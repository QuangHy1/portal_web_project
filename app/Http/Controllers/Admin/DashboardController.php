<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    //
    public function index(): View // Use the View type hint
    {
        return view('admin.dashboard.home.index');
    }
}
