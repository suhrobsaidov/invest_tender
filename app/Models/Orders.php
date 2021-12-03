<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;


    protected $fillable = [

        'users_id',
        'anouncements_id',
        

    ];

    
    public function users()
    {
        $this->belongsTo(User::class , 'users_id');
    }
    public function anouncements()
    {
        $this->hasMany(Anouncements::class , 'anouncements_id');
    }
    public function subscribers()
    {
        $this->belongsTo('App\Subscribers', 'id');
    }
    public function orders()
    {
          $this->hasMany(File::class);
    }
}
