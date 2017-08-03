<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 02.08.2017
 * Time: 12:54
 */

namespace Pinger\ServiceValidations\Transports;

interface ITransport
{
    /**
     * Returns response headers
     *
     * @return array
     */
    public function getHeaders(): array;

    /**
     * Returns response HTTP code
     *
     * @return string
     */
    public function getResponseCode(): string;

    /**
     * Returns response body content
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Retrive all messages - errors/logs/debug
     * @return array
     */
    public function getMessages(): array;
}