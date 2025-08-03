<?php

namespace App\Enums;

enum PostType: string
{
    case TEXT = 'TEXT';
    case VIDEO = 'VIDEO';
    case IMAGE = 'IMAGE';
    case LINK = 'LINK';
    case AUDIO = 'AUDIO';
    case POLL = 'POLL';
}
