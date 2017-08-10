<?php

namespace Pinger\ServiceNotices\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pinger\ServiceValidations\Contracts\IMethod;

class ServiceNotice extends Mailable
{
    use Queueable, SerializesModels;

    private $checkedMethod;

    /**
     * ServiceNotice constructor.
     * Create a new message instance.
     *
     * @param IMethod $checkedMethod
     */
    public function __construct(IMethod $checkedMethod)
    {
        $this->checkedMethod = $checkedMethod;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $result = $this->checkedMethod->result();
        $message = $result ? 'OK' : 'Failure';
        $serviceName = $this->checkedMethod->getService()->title;

        $this->subject('Service - ' . $serviceName . ' - ' . $message);

        return $this->markdown('emails.serviceNotice', compact('result', 'serviceName', 'message'));
    }
}
