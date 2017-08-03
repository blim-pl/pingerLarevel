<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 02.08.2017
 * Time: 12:31
 */

namespace Pinger\ServiceValidations\Transports;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Pinger\ServiceValidations\Contracts\ITransport;

final class CurlGuzzle implements ITransport
{
    private $config;
    private $client;
    private $response;
    private $messages = [];
    public static $requestMethods = ['GET', 'POST'];

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new Client();
    }

    /**
     * @return string
     */
    private function getUrl()
    {
        return $this->config['url'];
    }

    /**
     * @return string
     */
    private function getRequestMethod()
    {
        return $this->config['method'];
    }


    private function request()
    {
        $method = $this->getRequestMethod();

        if (in_array($method, self::$requestMethods)) {
            try {
                $this->response = $this->client->request($method, $this->getUrl());
            } catch (BadResponseException $ex) {
                $this->messages[] = sprintf('Response code id [%s]', $ex->getCode());
                $this->messages[] = $ex->getResponse()->getBody()->getContents();
            }
        } else {
            throw new \InvalidArgumentException(sprintf('Invalid request method [%s]', $method));
        }
    }

    /**
     * @return mixed
     */
    public function getResponseCode(): string
    {
        if (!$this->response) {
            $this->request();
        }

        return $this->response->getStatusCode();
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        if (!$this->response) {
            $this->request();
        }

        return $this->response->getBody()->getContents();
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
}