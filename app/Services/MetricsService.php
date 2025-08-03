<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;

class MetricsService
{
    /**
     * Record a unique metric (e.g., view or share) per post, IP address, and client UUID within 24 hours.
     *
     * This method ensures that only one metric entry is created per combination of:
     * - `post_id`
     * - `ip_address`
     * - `client_uuid` (from the `X-Client-UUID` request header)
     * within a 24-hour period.
     *
     * If an entry already exists for any of these identifiers in the given time range,
     * it will not create a duplicate and will return the existing UUID instead.
     *
     * @param  class-string<\Illuminate\Database\Eloquent\Model>  $model  The metric model class (e.g., \App\Models\PostView::class)
     * @param  array{
     *     post_id: int,
     *     ip_address: string
     * }  $data  Required data to identify the metric entry.
     *
     * @return string  The UUID of the existing or newly created metric record.
     *
     * @throws \InvalidArgumentException  If required data fields are missing.
     */
    public static function record(string $model, array $data): string
    {
        $uuid = request()->header('X-Client-UUID') ?? (string) Str::uuid();
        $ip = $data['ip_address'] ?? null;
        $postId = $data['post_id'] ?? null;

        if (!$ip || !$postId) {
            throw new \InvalidArgumentException('ip_address and post_id are required.');
        }


        $dayAgo = Carbon::now()->subDay();

        $existing = $model::where('post_id', $postId)
            ->where(function ($q) use ($ip, $uuid) {
                $q->where('ip_address', $ip)
                    ->orWhere('uuid', $uuid);
            })
            ->where('created_at', '>=', $dayAgo)
            ->first();


        if ($existing) {
            return $existing->uuid;
        }

        $record = $model::create([
            'post_id' => $postId,
            'ip_address' => $ip,
            'uuid' => $uuid,
        ]);

        return $record->uuid;
    }
}
