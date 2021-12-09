<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
      
    ];


public function anouncements()
{
    $this->hasOne(Anouncements::class);
}
public function user()
{
    $this->belongsTo(User::class);
}



}
