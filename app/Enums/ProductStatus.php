<?php

namespace App\Enums;

enum ProductStatus: string
{
    case PUBLISH = 'publish';
    case DRAFT = 'draft';
    case PENDING = 'pending';
}
