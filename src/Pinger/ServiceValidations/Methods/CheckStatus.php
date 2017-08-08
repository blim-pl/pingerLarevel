<?php
namespace Pinger\ServiceValidations\Methods;

use Pinger\ServiceValidations\Contracts\IMethod;

/**
 * Class CheckStatus
 * Method checks request code. Makes GET request.
 *
 * @package \Pinger\ServiceValidations\Methods
 *
 * TODO: switch GET/POST
 *
 */
class CheckStatus extends Method implements IMethod
{
    private $response;

    protected static $label = 'Sprawdź status odpowiedzi (HTTP Code)';
    protected static $value = 'checkStatus';

    public static function getMeta(): array
    {
        return [
            'label' => self::$label,
            'value' => self::$value
        ];
    }

    /**
     * @return IMethod
     */
    public function process(): IMethod
    {
        $this->response = $this->getResponseCode();

        return $this;
    }

    /**
     * @return bool
     */
    public function result(): bool
    {
        return intval($this->response) === intval($this->getExpects());
    }
}