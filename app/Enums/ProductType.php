<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ProductType: string implements HasColor, HasIcon, HasLabel, HasDescription
{
    case SIMPLE = 'simple';
    case VARIABLE = 'variable';
    case GROUPED = 'grouped';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::SIMPLE => 'success',
            self::VARIABLE, self::GROUPED => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::SIMPLE => 'heroicon-m-pencil',
            self::VARIABLE => 'heroicon-m-eye',
            self::GROUPED => 'heroicon-m-x-mark',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SIMPLE => __('product.type.simple'),
            self::VARIABLE => __('product.type.variable'),
            self::GROUPED => __('product.type.grouped'),
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::SIMPLE => 'This has not finished being written yet.',
            self::VARIABLE => 'This is ready for a staff member to read.',
            self::GROUPED => 'This has been approved by a staff member and is public on the website.',
        };
    }
}
