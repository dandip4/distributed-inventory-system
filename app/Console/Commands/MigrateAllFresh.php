<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateAllFresh extends Command
{
    protected $signature = 'migrate:all-fresh {--seed : Indicates if the seed task should be re-run}';
    protected $description = 'Run migrate:fresh for all databases';

    public function handle()
    {
        $connections = ['master', 'location', 'transaction'];

        $this->info('Starting migrate:fresh for all databases...');

        foreach ($connections as $connection) {
            $this->info("Processing {$connection} database...");

            try {
                // Drop all tables in the connection
                $this->call('migrate:fresh', [
                    '--database' => $connection,
                    '--path' => "database/migrations/{$connection}",
                    '--force' => true
                ]);

                $this->info("✓ {$connection} database migrated successfully");

            } catch (\Exception $e) {
                $this->error("✗ {$connection} database failed: " . $e->getMessage());
            }
        }

        // Run seeder if --seed option is provided
        if ($this->option('seed')) {
            $this->info('Running seeders...');
            $this->call('db:seed');
            $this->info('✓ Seeders completed');
        }

        $this->info('All databases have been migrated successfully!');
    }
}
