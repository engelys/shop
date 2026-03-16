<?php

namespace App\DTOs;

class CategoryDTO extends AutoConstructData
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $slug = null;
    public ?int $count = null;
    public ?int $parent_id = null;
    public ?string $display = null;
    public ?int $menu_order = null;
    public ?string $description = null;
    public ?string $created_at = null;
}
