<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Integrations\WP\Services\WPImportService;

class WPImport extends Command
{

    protected $signature = 'wp:import';

    public function __construct(
        private readonly WPImportService $importService
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->importService->collectProducts();
    }


}
