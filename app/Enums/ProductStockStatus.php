<?php

namespace App\Enums;

enum ProductStockStatus: string
{
    case OUTOFSTOCK = 'outofstock';
    case INSTOCK = 'instock';
    case ONBACKORDER = 'onbackorder';
}
