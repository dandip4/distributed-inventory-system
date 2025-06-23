<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckDatabase extends Command
{
    protected $signature = 'db:check';
    protected $description = 'Check all database connections and tables';

    public function handle()
    {
        $connections = ['master', 'location', 'transaction'];

        foreach ($connections as $connection) {
            $this->info("Checking {$connection} database...");

            try {
                // Test connection
                DB::connection($connection)->getPdo();
                $this->info("✓ {$connection} connection successful");

                // Show tables
                $tables = DB::connection($connection)->select('SHOW TABLES');
                $this->info("Tables in {$connection}:");

                foreach ($tables as $table) {
                    $tableName = array_values((array) $table)[0];
                    $this->line("  - {$tableName}");
                }

            } catch (\Exception $e) {
                $this->error("✗ {$connection} connection failed: " . $e->getMessage());
            }

            $this->line('');
        }
    }
}
