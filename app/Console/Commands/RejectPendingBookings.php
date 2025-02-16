<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class RejectPendingBookings extends Command
{
    protected $signature = 'booking:reject';
    protected $description = 'Reject all pending bookings older than 3 minutes.';

    public function handle()
    {
        $time = Carbon::now()->subMinutes(3);

        Booking::where('status', 'pending')
            ->where('created_at', '<', $time)
            ->update(['status' => 'rejected']);

        $this->info('Pending bookings older than 3 minutes have been rejected.');
    }
}
