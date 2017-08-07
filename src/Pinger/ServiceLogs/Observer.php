<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 03.08.2017
 * Time: 10:59
 */

namespace Pinger\ServiceLogs;

use CMS\Observer\Contracts\IObserver;
use CMS\Observer\Contracts\IObserverSubject;
use Pinger\ServiceLogs\Models\ServiceLogs;

class Observer implements IObserver
{
    private $checkMethod;

    private function save()
    {
        ServiceLogs::create([
            'service_id' => $this->checkMethod->getService()->id,
            'item_type' => ServiceLogs::$MONITORING,
            'result' => $this->checkMethod->result(),
            'data' => $this->checkMethod->getMessages()
        ]);
    }

    public function update(IObserverSubject $checkMethod)
    {
        $this->checkMethod = $checkMethod;

        $this->save();
    }
}