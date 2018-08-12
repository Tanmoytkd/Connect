<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'parent_id',
        'section_type',
        'completion_status',
        'section_image_path',
        'name'
    ];
}
