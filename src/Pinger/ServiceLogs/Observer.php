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
    private $checkMethod;

    private function save()
    {
        ServiceLogs::create([
            'service_id' => $this->checkMethod->getService()->id,
            'check_result' => $this->checkMethod->result(),
            'message' => $this->checkMethod->getMessagesString()
        ]);
    }

    public function update(IObserverSubject $checkMethod)
    {
        $this->checkMethod = $checkMethod;

        $this->save();
    }
}