<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PageSeoSetting;

class CheckCommoditySeo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:check-commodity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if commodity page is in SEO settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking commodity page in SEO settings...');
        
        $commoditySeo = PageSeoSetting::where('page_identifier', 'komoditas')->first();
        
        if ($commoditySeo) {
            $this->info('Commodity page found in SEO settings!');
            $this->info('Details:');
            $this->info('ID: ' . $commoditySeo->id);
            $this->info('Identifier: ' . $commoditySeo->page_identifier);
            $this->info('Page Name: ' . $commoditySeo->page_name);
            $this->info('Title: ' . $commoditySeo->title);
            $this->info('Description: ' . $commoditySeo->description);
            
            return Command::SUCCESS;
        }
        
        $this->error('Commodity page NOT found in SEO settings.');
        
        // List all available page identifiers
        $this->info('Available page identifiers:');
        $pages = PageSeoSetting::pluck('page_identifier')->toArray();
        $this->line(implode(', ', $pages));
        
        return Command::FAILURE;
    }
} 