<?php

namespace App\Http\Controllers;

use Pinger\ServiceLogs\Models\ServiceLogs;
use Pinger\ServiceLogs\Observer;
use Pinger\Services\Models\Service;

class ChecksController extends Controller
{
    /**
     * TODO: translations / dictionary (?)
     *
     * @param Service $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Service $service)
    {
        $methodClass = $service->validationMethod();
        $methodInstance = new $methodClass($service);

        $methodInstance->attach(new Observer());

        $result = $methodInstance->process()->result();

        if ($result) {
           $message = 'OK';
           $type = 'info';
        } else {
            $message = 'Lipa';
            $type = 'danger';
        }

        $methodInstance->notify();

        session()->flash('message', ['content' => $message, 'type' => $type]);

        return redirect()->route('services.index');
    }
}
