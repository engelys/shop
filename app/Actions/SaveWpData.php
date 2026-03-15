<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

class SaveWpData
{
    public function handle(
        array  $data,
        string $dataType,
        string $dataKey
    ): void
    {
        DB::table('wp_data')->insertOrIgnore([
            'type' => $dataType,
            'status' => 'new',
            'key' => $dataKey,
            'data' => json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
    }
}
