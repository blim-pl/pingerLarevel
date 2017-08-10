<?php

namespace Pinger\Services\Models;

use App\Model;
use App\User;
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

    /**
     * Service checks log
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
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
        return $this->log()->where('item_type', ServiceLogs::$MONITORING)->first();
    }

    public function emailsList()
    {
        return array_map('trim', explode(',', $this->emails));
    }

    public function lastNotice()
    {
        return $this->logs()->where([['service_id', $this->id],  ['item_type', ServiceLogs::$NOTICE]])->orderByDesc('created_at')->first();
    }

    public function scopeUserServices($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function isOwner(User $user)
    {
        return $user->id === $this->user_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
