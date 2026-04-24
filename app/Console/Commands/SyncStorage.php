<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class SyncStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync storage files to public directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $storagePublicPath = storage_path('app/public');
        $publicStoragePath = public_path('storage');

        if (!is_dir($publicStoragePath)) {
            mkdir($publicStoragePath, 0755, true);
            $this->info('Created public/storage directory');
        }

        $this->copyDirectory($storagePublicPath, $publicStoragePath);
        
        $this->info('Storage files synced successfully!');
        return 0;
    }

    /**
     * Copy directory recursively
     */
    private function copyDirectory($source, $destination): void
    {
        if (!is_dir($source)) {
            $this->error("Source directory does not exist: {$source}");
            return;
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        $copiedCount = 0;
        $updatedCount = 0;

        foreach ($iterator as $item) {
            $targetPath = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            
            if ($item->isDir()) {
                if (!is_dir($targetPath)) {
                    mkdir($targetPath, 0755, true);
                    $this->line("Created directory: {$targetPath}");
                }
            } else {
                $shouldCopy = !file_exists($targetPath) || filemtime($item) > filemtime($targetPath);
                
                if ($shouldCopy) {
                    copy($item, $targetPath);
                    if (!file_exists($targetPath)) {
                        $copiedCount++;
                        $this->line("Copied: {$iterator->getSubPathName()}");
                    } else {
                        $updatedCount++;
                        $this->line("Updated: {$iterator->getSubPathName()}");
                    }
                }
            }
        }

        if ($copiedCount > 0 || $updatedCount > 0) {
            $this->info("Synced {$copiedCount} new files, updated {$updatedCount} files");
        } else {
            $this->info('All files are already in sync');
        }
    }
}
