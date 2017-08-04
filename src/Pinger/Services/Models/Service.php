<?php

namespace Pinger\Services\Models;

use App\Model;
use Pinger\ServiceLogs\Models\ServiceLogs;
use Pinger\ServiceValidations\Methods\CheckContent;
use Pinger\ServiceValidations\Methods\CheckStatus;

class Service extends Model
{
    public $availableValidationMethods = [
        CheckStatus::class,
        CheckContent::class
    ];

    /**
     * @return array
     */
    public function validationMethods()
    {
        $data = [];

        foreach ($this->availableValidationMethods as $method) {
            $data[] = $method::getMeta();
        }

        return $data;
    }

    public function validationMethod()
    {
        $methods = $this->validationMethods();

        $found = array_search($this->valid_method, array_column($methods, 'value'));

        if ($found !== false) {
            return $this->availableValidationMethods[$found];
        }

        throw new \InvalidArgumentException(sprintf('Check service validation method [%]', $this->valid_method));
    }

    public function logs()
    {
        return $this->hasMany(ServiceLogs::class);
    }

    public function log()
    {
        return $this->logs()->orderByDesc('created_at');
    }

    public function lastLog()
    {
        return $this->log()->first();
    }

    public function emailsList()
    {
        return array_map('trim', explode(',', $this->emails));
    }
}
