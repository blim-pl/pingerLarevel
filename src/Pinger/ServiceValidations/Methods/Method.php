<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 01.08.2017
 * Time: 10:47
 */

namespace Pinger\ServiceValidations\Methods;

use Pinger\Observer\Contracts\IObserverSubject;
use Pinger\Observer\SubjectTrait;
use Pinger\Services\Models\Service;

abstract class Method implements IObserverSubject
{
    /**
     * Obser
     */
    use SubjectTrait;

    /**
     * @var Service Current service to process
     */
    protected $service;

    /**
     * @var tansport instance
     */
    protected $transport;

    /**
     * @var transport class to use
     */
    protected $transportClass;

    /**
     * @var array messages with errors|debug
     */
    protected $messages = [];

    /**
     * Method constructor.
     *
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;

        if ($this->transportClass) {
            $this->transport = new $this->transportClass([
                'url' => $this->service->url,
                'method' => 'GET'
            ]);
        }
    }

    public function getService(): Service
    {
        return $this->service;
    }

    /**
     * @return mixed
     */
    public function getExpects()
    {
        return $this->service->expects;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return array_merge($this->messages, $this->transport->getMessages());
    }

    /**
     * @param string $glue
     * @return string
     */
    public function getMessagesString($glue = "\r\n"): string
    {
        return implode($glue, $this->getMessages());
    }
}