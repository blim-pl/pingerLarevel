<?php

namespace Pinger\Services\Controllers;

use Illuminate\Support\Facades\Auth;
use Pinger\Services\Models\Service;
use Pinger\Services\Requests\ServiceRequest;

class Write
{
    const TEMPLATES_WWW = [
        'create' => 'services.create',
        'edit' => 'services.edit'
    ];

    const TAMPLTES_ADMIN = [
        'edit' => 'services.admin.edit'
    ];

    private $formFields = ['title', 'is_active', 'url', 'valid_method', 'expects', 'emails'];

    public function create()
    {
        $validationMethods = (new Service())->validationMethods();

        return compact('validationMethods');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Pinger\Services\Requests\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service($request->only($this->formFields));
        $service->setAttribute('user_id', Auth::user()->id);
        $service->save();

        return compact('service', 'request');
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

        return compact('service', 'validationMethods', 'service');
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
        $data = $request->only($this->formFields);

        $data['user_id'] = $service->id;

        $service->update($data);

        return compact('data', 'service', 'request');
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

        return compact('service');
    }
}
