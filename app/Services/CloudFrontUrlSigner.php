<?php

namespace App\Services;

use Aws\CloudFront\UrlSigner;
use Carbon\Carbon;

class CloudFrontUrlSigner
{
    private string $keyPairId;
    private string $privateKeyPath;
    private string $domain;

    public function __construct()
    {
        $this->keyPairId = config('services.cloudfront.key_pair_id');
        $this->privateKeyPath = config('services.cloudfront.private_key_path');
        $this->domain = config('services.cloudfront.domain');
    }

    /**
     * Generate signed URL valid for $expiresIn seconds.
     */
    public function getSignedUrl(string $path, int $expiresIn = 3600): string
    {
        $urlSigner = new UrlSigner($this->keyPairId, $this->privateKeyPath);

        $url = "https://{$this->domain}/" . ltrim($path, '/');

        $expires = Carbon::now()->addSeconds($expiresIn)->timestamp;

        return $urlSigner->getSignedUrl($url, $expires);
    }
}
