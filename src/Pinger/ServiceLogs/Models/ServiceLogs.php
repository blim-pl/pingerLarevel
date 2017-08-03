<?php
namespace Pinger\ServiceLogs\Models;

use App\Model;

class ServiceLogs extends Model
{
    public function services()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeLogsToService($query, Service $service)
    {
        return $query->where('service_id', $service->id);
    }
}
