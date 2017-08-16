<?php

namespace App\Http\Controllers\Admin;

use Pinger\Services\Controllers\Read;
use Pinger\Services\Controllers\Write;
use Pinger\Services\Models\Service;
use Pinger\Services\Requests\ServiceRequest;

class ServicesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (new Read())->index();

        $data['prefix'] = static::URL_PREXIX;

        return view(Read::TEMPLATES_ADMIN['index'], $data);
    }

    /**
     * Display the specified resource.
     *.@deprecated
     * @param  \Pinger\Services\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $data = (new Read())->show($service);

        return view(Read::TEMPLATES_ADMIN['show'], $data);
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

        $data['prefix'] = static::URL_PREXIX;

        return view(Write::TAMPLTES_ADMIN['edit'], $data);
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

        return redirect()->route('admin.services');
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

        return redirect()->route('admin.services');
    }
}
