<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorites extends Model
{
    use HasFactory;
    protected $fillable = [
      'users_id',
      'anouncements_id',
    ];

    public function users()
    {
        $this->belongsTo(User::class);
    }
    public function Anouncements()
    {
        $this->hasMany(Anouncement::class);
    }
}
