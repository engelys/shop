<?php

namespace App\Actions;

use App\DTOs\CategoryDTO;
use App\Http\Integrations\WP\Models\WPCategoryResponse;
use App\Models\Category;

class CreateCategory
{
    public function handle(WPCategoryResponse $recordDTO): void
    {
        if (!$recordDTO->id) {
            return;
        }

        if (Category::firstWhere('id', $recordDTO->id)) {
            return;
        }

        $dto = new CategoryDTO(...$recordDTO->toArray());

        $record = Category::create($dto->toArray());

        $record->saveQuietly();
    }
}
