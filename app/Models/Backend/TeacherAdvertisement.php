<?php

namespace App\Models\Backend;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherAdvertisement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['teacher_id','duration_id','approved','start_date','end_date'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class, 'duration_id');
    }
    public function getRemainingDaysAttribute()
    {
        $remainingDays = Carbon::now()->diffInDays($this->end_date, false);
        return $remainingDays > 0 ? $remainingDays : 0;
    }
}
