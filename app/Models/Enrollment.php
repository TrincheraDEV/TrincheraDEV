<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'enrolled_at'];

    protected $dates = ['enrolled_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public static function enrolledToCourse($courseId, $userId)
    {
        if (Enrollment::query()->where('course_id', '=', $courseId)->where('user_id', '=', $userId)->first()) {
            return true;
        }
        
        return false;
    }
}
