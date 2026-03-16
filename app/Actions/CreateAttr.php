<?php

namespace App\Actions;

use App\DTOs\AttrDTO;
use App\Http\Integrations\WP\Models\WPAttrResponse;
use App\Models\Attribute;

class CreateAttr implements CreateAction
{
    public function handle(WPAttrResponse $recordDTO): void
    {
        if (!$recordDTO->id) {
            return;
        }

        if (Attribute::firstWhere('id', $recordDTO->id)) {
            return;
        }

        $dto = new AttrDTO(...$recordDTO->toArray());

        $record = Attribute::create($dto->toArray());

        $record->saveQuietly();
    }
}
