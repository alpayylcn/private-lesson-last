<?php

namespace App\Console\Commands;

use App\Models\Backend\TeacherAdvertisement;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckAdvertisements extends Command
{
    protected $signature = 'check:advertisements';
    protected $description = 'Check advertisements and soft delete those that have expired';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Aktif ve süresi dolmuş ilanları bul
        $expiredAdvertisements = TeacherAdvertisement::where('end_date', '<', Carbon::now())
            ->whereNull('deleted_at')
            ->get();

        foreach ($expiredAdvertisements as $advertisement) {
            // Soft delete işlemi
            $advertisement->delete();
            $this->info("Soft deleted advertisement ID: {$advertisement->id}");
        }
    }
}
