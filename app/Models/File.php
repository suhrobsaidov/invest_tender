<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = 'files';

    protected $fillable = [
        'users_id',
        'name',
        'path',
        
    ];
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function orders()
    {
      return $this->belongsTo(Orders::class);
    }
}
