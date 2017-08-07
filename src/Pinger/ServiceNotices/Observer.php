<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 04.08.2017
 * Time: 14:17
 */

namespace Pinger\ServiceNotices;

use Pinger\ServiceLogs\Models\ServiceLogs;
use Pinger\ServiceNotices\Mail\ServiceNotice;
use Illuminate\Support\Facades\Mail;
use CMS\Observer\Contracts\IObserver;
use CMS\Observer\Contracts\IObserverSubject;

class Observer implements IObserver
{
    private $checkMethod;

    protected function saveLog($data)
    {
        ServiceLogs::create($data);
    }

    public function send()
    {
        $emails = $this->checkMethod->getService()->emailsList();

        if (!empty($emails)) {
            $mail = new ServiceNotice($this->checkMethod);
            $mail->to($emails);
            Mail::send($mail);
        }

        $this->saveLog([
            'service_id' => $this->checkMethod->getService()->id,
            'item_type' => ServiceLogs::$NOTICE,
            'result' => $mail ? (Mail::failures() ? false : true) : false,
            'data' => [
                'emails' => $this->checkMethod->getService()->emails,
                'message' => $mail ? $mail->subject : 'skip sending'
            ],

        ]);
    }

    /**
     * Send if last status is different than current.
     * Send when failure, use send delay
     *
     * @return bool
     */
    protected function canProcess()
    {
        $lastNotice = $this->checkMethod->getService()->lastNotice();
        $lastLog = $this->checkMethod->getService()->lastLog();
        $currentResult = $this->checkMethod->result();

        if (
            !$lastNotice //is first notice
            || false === $lastNotice->result //last notice result fails
            || $lastLog && $lastLog->result != $currentResult //current check method result is different than last (FAIL => OK, OK => FAIL)
            //status is still failure and delay is reached
            || ($lastLog && false == $lastLog->result && time() - $lastNotice->created_at->timestamp > config('app.pinger.notice-delay', 0))
        ) {
            return true;
        }

        return false;
    }

    public function update(IObserverSubject $checkMethod)
    {
        $this->checkMethod = $checkMethod;

        if ($this->canProcess()) {
            $this->send();
        } else {
        }
    }
}