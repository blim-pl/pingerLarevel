<?php

namespace Pinger\Checks\Controllers;

use Pinger\ServiceNotices\Observer as MailerObserver;
use Pinger\ServiceLogs\Observer as LogsObserver;
use Pinger\Services\Models\Service;

class Checks
{
    /***
     * @param Service $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getMethodInstance(Service $service)
    {
        $methodClass = $service->validationMethod();
        $transportClass = config('app.pinger.services-transport');

        $methodInstance = new $methodClass($service, new $transportClass());

        $methodInstance
            ->attach(new MailerObserver())
            ->attach(new LogsObserver());

        return $methodInstance;
    }
}
