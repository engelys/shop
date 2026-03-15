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
    case TRASH = 'trash';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PUBLISH => 'success',
            self::TRASH => 'warning',
            self::DRAFT => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PUBLISH => 'heroicon-m-check',
            self::TRASH => 'heroicon-m-clock',
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
            self::PUBLISH => 'This is published record available on the website.',
            self::TRASH => 'This is deleted record hidden on the website.',
            self::DRAFT => 'This is hidden on the website record no published yet.',
        };
    }
}
