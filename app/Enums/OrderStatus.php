<?php

namespace App\Enums;

use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum OrderStatus: string implements HasColor, HasIcon, HasLabel
{
    case HOLD = 'on-hold';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::HOLD => 'warning',
            self::PROCESSING => 'info',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
        };
    }

    public function getIcon(): string|BackedEnum|Htmlable|null
    {
        return match ($this) {
            self::HOLD => 'heroicon-m-clock',
            self::PROCESSING => 'heroicon-m-clock',
            self::COMPLETED => 'heroicon-m-check',
            self::CANCELLED => 'heroicon-m-x-mark',
        };
    }

    public function getLabel(): string|Htmlable|null
    {
        return $this->value;
    }
}
