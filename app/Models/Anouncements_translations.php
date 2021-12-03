<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anouncements_translations extends Model
{
    use HasFactory;
    protected $fillable = 
    [ 
        'files',
        'tender_owner',
        'orders_id',
        'lot_name',
        'tender_title',
        'language',
        'description'
    ];

    public function Anouncement()
    {
        return $this->morphMany(Anouncement::class);
    }
}
