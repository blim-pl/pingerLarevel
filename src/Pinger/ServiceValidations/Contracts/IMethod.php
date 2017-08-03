<?php
namespace Pinger\ServiceValidations\Contracts;

interface IMethod
{
    public function process(): IMethod;

    /**
     * Compare response from request to expect value
     *
     * @return bool
     */
    public function result(): bool;

    /**
     * Returns method description to users view
     *
     * @return array
     */
    public static function getMeta(): array;

    /**
     * Returns expect value
     *
     * @return mixed
     */
    public function getExpects();

    /**
     * Retrive all messages - errors/logs/debug
     *
     * @return array
     */
    public function getMessages(): array;

    /**
     * Get messages as string
     *
     * @param string $glue
     * @return string
     */
    public function getMessagesString($glue = "\r\n"): string;
}