<?php

namespace App\Http\Controllers;

use Pinger\Services\Models\Service;
use Pinger\Services\Requests\ServiceRequest;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validationMethods = (new Service())->validationMethods();

        return view('services.create', compact('validationMethods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Pinger\Services\Requests\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        Service::create(request(['title', 'is_active', 'url', 'valid_method', 'expects']));

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Pinger\Services\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $logs = $service->serviceLogs;

        return view('services.show', compact('service', 'logs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Pinger\Services\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $validationMethods = (new Service())->validationMethods();

        return view('services.edit', compact('service', 'validationMethods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Pinger\Services\Requests\ServiceRequest  $request
     * @param  \Pinger\Services\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->only(['title', 'is_active', 'url', 'valid_method', 'expects']));

        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Pinger\Services\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index');
    }
}
