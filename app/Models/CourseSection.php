<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseSection extends Pivot
{
    protected $table = 'course_section';

    public $incrementing = true;

    protected $fillable = ['course_id', 'section_id', 'order'];
}