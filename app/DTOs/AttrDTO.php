<?php

namespace App\DTOs;

class AttrDTO extends AutoConstructData
{
    public ?int $id = null;
    public ?string $name = null;
    public ?array $names = [];
    public ?string $slug = null;
    public ?string $type = null;
    public ?string $order_by = null;
    public ?bool $has_archives = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;
}
