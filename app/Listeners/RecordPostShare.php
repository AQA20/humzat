<?php

namespace App\Listeners;

use App\Models\PostShare;
use App\Events\PostShared;
use App\Services\MetricsService;

class RecordPostShare
{
    public function handle(PostShared $event): void
    {
        MetricsService::record(PostShare::class, [
            'post_id' => $event->post->id,
            'ip_address' => $event->ipAddress,
        ]);
    }
}
