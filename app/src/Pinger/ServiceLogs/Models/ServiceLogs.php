<?php
namespace Pinger\ServiceLogs\Models;

use App\Model;
use Pinger\Services\Models\Service;

class ServiceLogs extends Model
{
    public static $MONITORING = 'monitoring';
    public static $NOTICE = 'notice';

    public static $typesMap = [
        'monitoring' => 'Monitoring',
        'notice' => 'Powiadomienie email'
    ];

    /**
     * array to JSON -> magic
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeLogsToService($query, Service $service)
    {
        return $query->where('service_id', $service->id);
    }
}
