<?php

namespace App\Enums;

enum MediaType: string
{
    case YOUTUBE = 'youtube';
    case VIMEO = 'vimeo';
    case IMAGE = 'image';
    case TWITTER = 'twitter';
    case FACEBOOK = 'facebook';
    case TIKTOK = 'tiktok';
}
