<?php

namespace App\Listeners;

use App\Models\PostView;
use App\Events\PostViewed;
use App\Services\MetricsService;

class RecordPostView
{
    public function handle(PostViewed $event): void
    {
        MetricsService::record(PostView::class, [
            'post_id' => $event->post->id,
            'ip_address' => $event->ipAddress,
        ]);
    }
}
