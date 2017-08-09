<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Pinger\ServiceLogs\Models\ServiceLogs;
use Pinger\Services\Models\Service;
use Pinger\Services\Requests\ServiceRequest;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::userServices(Auth::user())->get();

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
        $service = new Service($request->only(['title', 'is_active', 'url', 'valid_method', 'expects', 'emails']));
        $service->setAttribute('user_id', Auth::user()->id);
        $service->save();

        //Service::create($data);

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
        $logs = $service->log()->paginate(10);
        $itemTypes = ServiceLogs::$typesMap;

        return view('services.show', compact('service', 'logs', 'itemTypes'));
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
        $data = $request->only(['title', 'is_active', 'url', 'valid_method', 'expects', 'emails']);

        $data['user_id'] = $service->id;

        $service->update($data);

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

        session()->flash('message', ['content' => __('common.Item has been deleted'), 'type' => 'info']);

        return redirect()->route('services.index');
    }
}
