<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{
    use HasFactory;

    protected $fillable = [
         'name',
        'users_id',
        'birth_city',
        'last_name',
        'middle_name',
        'company_name',
        'phone',
        'company_country',
        'inn',
        'division',
        'email',
        'town',
        'postal_code',
        'address_lin1',
        'address_lin2',
        'address_lin3'
     

    ];

    public function users()
    {
        $this->belongsTo(User::class);
    }
    public function orders()
  
    {
        $this->belongsTo('App\Orders', 'id')->where('id',0);
    }



}
