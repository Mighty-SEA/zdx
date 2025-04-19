<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PageSeoSetting;

class CleanupOldSeoSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:cleanup-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old SEO settings with outdated identifiers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Cleaning up old SEO settings...');
        
        // Delete old commodity entry
        $oldSettings = PageSeoSetting::where('page_identifier', 'commodity')->first();
        
        if ($oldSettings) {
            $id = $oldSettings->id;
            $oldSettings->delete();
            $this->info("Deleted old 'commodity' entry with ID: $id");
        } else {
            $this->info("No old 'commodity' entry found.");
        }
        
        $this->info('Cleanup completed!');
        
        return Command::SUCCESS;
    }
} 