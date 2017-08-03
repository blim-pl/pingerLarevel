<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 03.08.2017
 * Time: 10:59
 */

namespace Pinger\ServiceLogs;

use Pinger\Observer\Contracts\IObserver;
use Pinger\Observer\Contracts\IObserverSubject;
use Pinger\ServiceLogs\Models\ServiceLogs;

class Observer implements IObserver
{
    public function update(IObserverSubject $checkMethod)
    {
        ServiceLogs::create([
            'service_id' => $checkMethod->getService()->id,
            'check_result' => $checkMethod->result(),
            'message' => $checkMethod->getMessagesString()
        ]);
    }
}