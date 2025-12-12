<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CategoryDisplay: string implements HasColor, HasIcon, HasLabel, HasDescription
{
    case BOTH = 'both';
    case DEFAULT = 'default';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::BOTH => 'success',
            self::DEFAULT => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::BOTH => 'heroicon-m-check',
            self::DEFAULT => 'heroicon-m-clock',
        };
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::BOTH => 'This has not finished being written yet.',
            self::DEFAULT => 'This is ready for a staff member to read.',
        };
    }
}
