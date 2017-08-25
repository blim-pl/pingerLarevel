<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Pinger\ServiceLogs\Models\ServiceLogs;
use Pinger\Services\Models\Service;

class DashboardController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = ServiceLogs::take(5)->orderByDesc('created_at')->get();

        $services = Service::take(5)->orderByDesc('updated_at')->get();

        return view('admin.dashboard.index', compact('logs', 'services'));
    }
}
