<?php

namespace App\Http\Controllers;

use Pinger\Services\Controllers\Read;
use Pinger\Services\Controllers\Write;
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
        $data = (new Read)->index();

        return view(Read::TEMPLATES_WEB['index'], $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = (new Write())->create();

        return view(Write::TEMPLATES_WWW['create'], $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Pinger\Services\Requests\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $data = (new Write())->store($request);

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
        $data = (new Read())->show($service);

        return view(Read::TEMPLATES_WEB['show'], $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Pinger\Services\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $data = (new Write())->edit($service);

        return view(Write::TEMPLATES_WWW['edit'], $data);
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
        (new Write())->update($request, $service);

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
        (new Write())->destroy($service);

        return redirect()->route('services.index');
    }
}
