<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\PageSeoController;

class InitializeSeoDefaults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize default SEO settings for all pages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Initializing default SEO settings...');
        
        $controller = new PageSeoController();
        $result = $controller->initializeDefaults();
        
        $this->info('Default SEO settings have been initialized successfully!');
        $this->info('Now you should see Commodity page in SEO settings.');
        
        return Command::SUCCESS;
    }
}
