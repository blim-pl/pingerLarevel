<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 04.08.2017
 * Time: 14:17
 */

namespace Pinger\Mailer;

use App\Mail\ServiceNotice;
use Illuminate\Support\Facades\Mail;
use Pinger\Observer\Contracts\IObserver;
use Pinger\Observer\Contracts\IObserverSubject;

class Observer implements IObserver
{
    private $checkMethod;

    public function send()
    {
        $emails = $this->checkMethod->getService()->emailsList();

        if (!empty($emails)) {
            $mail = new ServiceNotice($this->checkMethod);
            $mail->to($emails);

            Mail::send($mail);
        }
    }

    public function update(IObserverSubject $checkMethod)
    {
        $this->checkMethod = $checkMethod;

        $this->send();
    }
}