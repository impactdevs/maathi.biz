<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        foreach (['created', 'updated', 'deleted'] as $event) {
            static::$event(function ($model) use ($event) {
                AuditLog::create([
                    'user_id' => Auth::id(),
                    'event' => $event,
                    'model' => get_class($model),
                    'old_data' => $event === 'updated' ? json_encode($model->getOriginal()) : null,
                    'new_data' => $event !== 'deleted' ? json_encode($model->getAttributes()) : null,
                    'ip_address' => request()->ip(),
                ]);
            });
        }
    }
}
