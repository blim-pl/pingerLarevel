<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 01.08.2017
 * Time: 10:47
 */

namespace Pinger\ServiceValidations\Methods;

use CMS\Observer\Contracts\IObserverSubject;
use CMS\Observer\SubjectTrait;
use Pinger\Services\Models\Service;
use Pinger\ServiceValidations\Contracts\ITransport;

abstract class Method implements IObserverSubject
{
    /**
     * Observer
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
     * @param Service $service
     * @param ITransport $transport
     */
    public function __construct(Service $service, ITransport $transport)
    {
        $this->service = $service;

        $this->transport = $transport;
        $this->transport
            ->setUrl($this->service->url)
            ->setRequestMethod('GET');
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

    public function getResponseCode(): int
    {
        return $this->transport->getResponseCode();
    }
}