<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!app()->runningInConsole()) {
            $forwardedProto = request()->header('x-forwarded-proto');
            $forwardedSsl = request()->header('x-forwarded-ssl');

            if ($forwardedProto === 'https' || $forwardedSsl === 'on') {
                URL::forceScheme('https');
            }
        }

        // Auto-sync storage files to public directory for Windows environments
        if (app()->environment('local') && strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->syncStorageFiles();
        }
    }

    /**
     * Sync storage files to public directory
     */
    private function syncStorageFiles(): void
    {
        $storagePublicPath = storage_path('app/public');
        $publicStoragePath = public_path('storage');

        if (!is_dir($publicStoragePath)) {
            mkdir($publicStoragePath, 0755, true);
        }

        $this->copyDirectory($storagePublicPath, $publicStoragePath);
    }

    /**
     * Copy directory recursively
     */
    private function copyDirectory($source, $destination): void
    {
        if (!is_dir($source)) {
            return;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $targetPath = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            
            if ($item->isDir()) {
                if (!is_dir($targetPath)) {
                    mkdir($targetPath, 0755, true);
                }
            } else {
                if (!file_exists($targetPath) || filemtime($item) > filemtime($targetPath)) {
                    copy($item, $targetPath);
                }
            }
        }
    }
}
