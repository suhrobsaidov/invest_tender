<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anouncement extends Model
{
    use HasFactory;

     
    protected $fillable = [
        'files',
        'tender_owner',
        'orders_id',
        'lot_name',
        'tender_title',
        'deadline',
        'price',
        'description'
    ];

   
    public function Orders()
    {
        return $this->hasMany(Orders::class);
    }
    public function Users()
    {
        $this->belongsTo(User::class);
    }
}
