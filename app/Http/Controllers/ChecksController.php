<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Pinger\ServiceNotices\Observer as MailerObserver;
use Pinger\ServiceLogs\Observer as LogsObserver;
use Pinger\Services\Models\Service;

class ChecksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $transportClass = config('app.pinger.services-transport');

        $methodInstance = new $methodClass($service, new $transportClass());

        $methodInstance
            ->attach(new MailerObserver())
            ->attach(new LogsObserver());

        $result = $methodInstance->process()->result();

        $methodInstance->notify();

        if ($result) {
            $message = 'OK';
            $type = 'info';
        } else {
            $message = 'Lipa';
            $type = 'danger';
        }

        flashMessage($message, $type);

        return back();
        //return redirect()->route('services.index');
    }
}
