<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anouncement extends Model
{
    use HasFactory;

     
    protected $fillable = [
        
        'tender_owner',
        'orders_id',
        'projects_id',
        'name',
        'tender_title',
        'deadline',
        'price',
        'description',
        'procurement_method',
        'type_of_procurement',
        'project_center_anouncement_id',
        'number_of_lots'




    ];

   
    public function Orders()
    {
        return $this->hasMany(Orders::class);
    }
    public function Users()
    {
        $this->belongsTo(User::class);
    }
    public function projects()
    {
        $this->belongsTo(Projects::class);
    }
}
