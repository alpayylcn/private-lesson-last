<?php

namespace App\Console\Commands;

use App\Models\Backend\RequestDuration;
use App\Models\Backend\TeacherAppointmentList;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DeleteExpiredAppointments extends Command
{
    // Öğretmeni ben seçeceğim seçeneğinden gelen ilanları silinmesi
     // Komutun adı
     protected $signature = 'appointments:delete-expired';

     // Komutun açıklaması
     protected $description = 'Süresi dolan randevuları sil';
 
     public function __construct()
     {
         parent::__construct();
     }
 
     public function handle()
     {
         // request_durations tablosundan duration_days değerini alıyoruz
         $duration = RequestDuration::first(); // duration_days bilgisini buradan çekiyoruz
         $days = $duration->duration_days;
 
         // Süresi dolan randevuları al
         $expiredAppointments = TeacherAppointmentList::where('created_at', '<', Carbon::now()->subDays($days))
             ->get();
 
         // Soft delete yap
         foreach ($expiredAppointments as $appointment) {
             $appointment->delete();
         }
 
         // Bilgilendirme mesajı
         $this->info('Süresi dolan randevular başarıyla silindi.');
     }
}

