<?php

namespace App\Http\Controllers;

use Pinger\ServiceLogs\Models\ServiceLogs;
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

        $result = $methodInstance->process()->result();

        if ($result) {
           $message = 'OK';
           $type = 'info';
        } else {
            $message = 'Lipa';
            $type = 'danger';
        }

        ServiceLogs::create([
           'service_id' => $service->id,
            'check_result' => $result,
            'message' => $methodInstance->getMessagesString()
        ]);

        session()->flash('message', ['content' => $message, 'type' => $type]);

        return redirect()->route('services.index');
    }
}
