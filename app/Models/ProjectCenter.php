<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCenter extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name'
    ];

    public function projects()
    {
        $this->belengsTo('Projects::class');
    }
}


