<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'location',
        'category',
        'description',
        'year',
        'status',
        'cover_image',
        'sort_order',
        'featured',
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function renders()
    {
        return $this->hasMany(ProjectImage::class)->where('type', 'render')->orderBy('sort_order');
    }

    public function completedImages()
    {
        return $this->hasMany(ProjectImage::class)->where('type', 'completed')->orderBy('sort_order');
    }
}