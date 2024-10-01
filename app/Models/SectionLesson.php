<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SectionLesson extends Pivot
{
    protected $table = 'section_lesson';

    public $incrementing = true;

    protected $fillable = ['section_id', 'lesson_id', 'order'];
}