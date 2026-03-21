<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ProductStockStatus: string implements HasColor, HasIcon, HasLabel, HasDescription
{
    case OUTOFSTOCK = 'outofstock';
    case INSTOCK = 'instock';
    case ONBACKORDER = 'onbackorder';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::INSTOCK => 'success',
            self::ONBACKORDER => 'warning',
            self::OUTOFSTOCK => 'danger',
        };
    }


    public function getIcon(): ?string
    {
        return match ($this) {
            self::INSTOCK => 'heroicon-m-check',
            self::OUTOFSTOCK, self::ONBACKORDER => 'heroicon-m-x-mark',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::INSTOCK => __('product.stock_status.instock'),
            self::ONBACKORDER => __('product.stock_status.onbackorder'),
            self::OUTOFSTOCK => __('product.stock_status.outofstock'),
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::OUTOFSTOCK => 'This has not finished being written yet.',
            self::INSTOCK => 'This is ready for a staff member to read.',
            self::ONBACKORDER => 'This has been approved by a staff member and is public on the website.',
        };
    }
}
