<?php

namespace Pinger\Services\Controllers;

use Illuminate\Support\Facades\Auth;
use Pinger\ServiceLogs\Models\ServiceLogs;
use Pinger\Services\Models\Service;

class Read
{
    const TEMPLATES_WEB = [
        'index' => 'services.index',
        'show' => 'services.show'
    ];

    const TEMPLATES_ADMIN = [
        'index' => 'services.admin.index',
        'show' => 'services.admin.show'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::userServices(Auth::user())->paginate(10);

        return compact('services');
    }

    public function adminIndex()
    {
        $services = Service::paginate(10);

        return compact('services');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Pinger\Services\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $logs = $service->log()->paginate(10);
        $itemTypes = ServiceLogs::$typesMap;

        return compact('service', 'logs', 'itemTypes');
    }
}
