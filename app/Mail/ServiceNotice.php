<?php

namespace App\Mail;

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
     * Create a new message instance.
     *
     * @return void
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
        $serviceName = $this->checkedMethod->getService()->title;
        return $this->markdown('emails.serviceNotice', compact('result', 'serviceName'));
    }
}
