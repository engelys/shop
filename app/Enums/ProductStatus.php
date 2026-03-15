<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ProductStatus: string implements HasColor, HasIcon, HasLabel, HasDescription
{
    case PUBLISH = 'publish';
    case DRAFT = 'draft';
    case PENDING = 'pending';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PUBLISH => 'success',
            self::PENDING => 'warning',
            self::DRAFT => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PUBLISH => 'heroicon-m-check',
            self::PENDING => 'heroicon-m-clock',
            self::DRAFT => 'heroicon-m-pencil',
        };
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::PUBLISH => 'This has not finished being written yet.',
            self::PENDING => 'This is ready for a staff member to read.',
            self::DRAFT => 'This has been approved by a staff member and is public on the website.',
        };
    }
}
