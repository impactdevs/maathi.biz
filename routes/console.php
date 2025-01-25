<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('logs:delete-old', function () {
    // Delete logs older than 7 days
    $deleted = DB::table('audit_logs')
        ->where('created_at', '<', Carbon::now()->subWeek()) // Older than 7 days
        ->delete();

    // Output how many logs were deleted
    $this->info("Deleted $deleted old logs.");
})->purpose('Delete audit logs older than 7 days')->daily();
