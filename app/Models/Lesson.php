<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'video_id', 'content', 'status'];
    
    protected $casts = [
        'status' => Status::class,
    ];

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class, 'lesson_section')->withPivot('order');
    }

    public function getCourseId(): int
    {
        $section = $this->sections->first();
        return $section && $section->course ? $section->course->id : 0;
    }

    public function getCourseTitle(): string
    {
        $section = $this->sections->first();
        return $section && $section->course ? $section->course->title : 'N/A';
    }

    public function getFormattedContentAttribute()
    {
        return Str::markdown($this->content);
    }

    public function completions()
    {
        return $this->hasMany(LessonCompletion::class);
    }

    public function completedByUsers()
    {
        return $this->belongsToMany(User::class, 'lesson_completions')->withTimestamp('completed_at');
    }
}
