<?php

namespace App\Console\Commands;

use App\Models\Backend\LessonRequest;
use Illuminate\Console\Command;

class DecreaseLessonRequestDuration extends Command
{
    // öğretmen beni arasın seçeneğinden gelen ilanları silinmesi
    protected $signature = 'requests:decrease-duration';
    protected $description = 'Decrease request duration by 1 day and remove expired requests';

    public function handle()
    {
        $requests = LessonRequest::where('request_duration', '>', 0)->get();

        foreach ($requests as $request) {
            $request->decrement('request_duration');

            if ($request->request_duration <= 0) {
                $request->delete(); // İsteği kaldırma işlemi
            }
        }

        $this->info('Request durations updated successfully.');
    }
}
