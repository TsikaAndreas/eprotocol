<?php

namespace App\Listeners;

class BackupActivityManager
{
    public function successfulBackup() {
        activity('successful-backup')
            ->log('Successfully created new backup!');
    }
    public function failedBackup() {
        activity('failed-backup')
            ->log('Failed to backup.');
    }
    public function successfulCleanup() {
        activity('successful-cleanup')
            ->log('Clean up of backups was successful!');
    }
    public function failedCleanup() {
        activity('failed-cleanup')
            ->log('Cleaning up the backups failed.');
    }
}
