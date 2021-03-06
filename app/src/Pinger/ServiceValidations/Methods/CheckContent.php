<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 01.08.2017
 * Time: 13:22
 */

namespace Pinger\ServiceValidations\Methods;

use Pinger\ServiceValidations\Contracts\IMethod;

class CheckContent extends Method implements IMethod
{
    protected static $label = 'Wyszukanie w treści odpowiedzi - frazy po przecinku';
    protected static $value = 'checkContent';

    private $encoding = 'UTF-8';
    private $response;


    public static function getMeta(): array
    {
        return [
            'label' => self::$label,
            'value' => self::$value
        ];
    }

    public function process(): IMethod
    {
        $this->response = $this->transport->getContent();
        return $this;
    }

    /**
     * @param $encoding
     * @param $content
     * @return mixed|string
     */
    private function convertCharset($encoding, $content)
    {
        if ($encoding && $encoding != $this->encoding) {
            return mb_convert_encoding($content, $this->encoding, $encoding);
        }

        return $content;
    }

    /**
     * Checks encoding, try to convert to UTF8 if is different
     *
     * @return string
     */
    private function getContent(): string
    {
        $content = $this->response;

        $encoding = '';

        foreach ($this->transport->getHeaders() as $headerValues) {

            if (!is_array($headerValues)) {
                $headerValues = [$headerValues];
            }

            foreach ($headerValues as $headerValue) {
                preg_match_all('/charset="?([a-z\-\d]+)"?/i', $headerValue, $m);

                if ($m[1] && $m[1][0]) {
                    $encoding = $m[1][0];
                    break;
                }
            }
        }

        return $this->convertCharset($encoding, $content);
    }

    public function result(): bool
    {
        if (strpos($this->service->expects, ',') !== false) {
            $keywords = array_map('trim', explode(', ', $this->service->expects));
        } else {
            $keywords = [trim($this->service->expects)];
        }

        $result = true;
        $content = $this->getContent();

        foreach ($keywords as $keyword) {
            if (strpos($content, $keyword) === false) {
                $result = false;
                break;
            }
        }

        return $result;
    }
}