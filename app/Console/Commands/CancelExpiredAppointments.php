<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;

class CancelExpiredAppointments extends Command
{
    protected $signature = 'appointments:cancel-expired';
    protected $description = 'Batalkan janji berstatus menunggu yang tanggalnya sudah lewat';

    public function handle()
    {
        $jumlah = Appointment::where('status', 'menunggu')
            ->whereDate('visit_date', '<', today())
            ->update(['status' => 'dibatalkan']);

        $this->info("{$jumlah} appointment kedaluwarsa dibatalkan.");
    }
}