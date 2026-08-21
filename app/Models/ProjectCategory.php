<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name_bn', 'name_en', 'description', 'icon', 'color', 'name', 'slug'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}