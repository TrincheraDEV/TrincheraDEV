<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'image', 'video_id', 'status'];

    protected $casts = [
        'status' => Status::class,
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments')->withTimestamp('enrolled_at');
    }
}