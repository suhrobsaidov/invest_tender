<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Auth;
use Illuminate\Routing\Route;


class User extends Authenticatable implements JWTSubject 
{
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'project_name'
       
        
      

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
   

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    public function subscribers()
    {
        $this->hasOne(Subscribers::class);
    }

   public function orders()
   {
       $this->hasMany(Orders::class);
   }
   public function favorites()
   {
       $this->hasMany(Favarites::class);
   }
   public function anouncements()
   {
    $this->hasMany(Anouncement::class);
   }
   public function projects()
   {
       $this->hasMany(Projects::class);
   }

    public function payments()
    {
        $this->hasMany(Payments::class);
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
      
        $user = User::all();
        $user_id = $this->getJWTIdentifier();
        if (User::where('id', $user_id)->exists()){
 
       return [$user = User::where('id' ,$user_id)->get('role')];
        }


       }
    public function tokenValid()
{
    if (Carbon::parse($this->attributes['expires_at']) < Carbon::now()) {
        return true;
    }
    return false;
}


    
}