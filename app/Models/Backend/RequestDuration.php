<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDuration extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_type',
        'duration_days',
    ];

    /**
     * İlişkiyi tanımlar: RequestDuration birden fazla LessonRequest ile ilişkilendirilebilir.
     */
    public function lessonRequests()
    {
        return $this->hasMany(LessonRequest::class);
    }
}
