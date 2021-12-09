<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsCenter extends Model
{
    use HasFactory;
    protected $fillable = [

        'name'
    ];
    public function projects()
    {
        $this->belongTo(Projects::class);
    }

    
}
