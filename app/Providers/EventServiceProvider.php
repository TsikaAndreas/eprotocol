<?php

namespace App\Providers;

use App\Events\AuthLoginHandler;
use App\Listeners\BackupActivityManager;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\Backup\Events\BackupHasFailed;
use Spatie\Backup\Events\BackupWasSuccessful;
use Spatie\Backup\Events\CleanupHasFailed;
use Spatie\Backup\Events\CleanupWasSuccessful;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [SendEmailVerificationNotification::class],
        Login::class => [[AuthLoginHandler::class, 'login']],
        Logout::class => [[AuthLoginHandler::class, 'logout']],
        Failed::class => [[AuthLoginHandler::class, 'failed']],
        BackupWasSuccessful::class => [[BackupActivityManager::class, 'successfulBackup']],
        BackupHasFailed::class => [[BackupActivityManager::class, 'failedBackup']],
        CleanupWasSuccessful::class => [[BackupActivityManager::class, 'successfulCleanup']],
        CleanupHasFailed::class => [[BackupActivityManager::class, 'failedCleanup']],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
