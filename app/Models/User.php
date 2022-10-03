<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  //-------------------------------------------------------------------------------------

  protected static function boot()
  {
    parent::boot();

    //CAPTURA EVENTO DE DELETE DO USER

    static::deleting(function($user)
    {
      foreach($user->UserPermissions as $userPermission)
        $userPermission->delete();
    });
  }

  //-------------------------------------------------------------------------------------

  public function UserPermissions()
  {
    return $this->hasMany(UserPermission::Class, 'id_user', 'id');
  }

  //-------------------------------------------------------------------------------------

  public function Permissions()
  {
    return $this->hasManyThrough(Permission::Class,
                                 UserPermission::Class,
                                 'id_user',
                                 'id_permission',
                                 'id',
                                 'id_permission');
  }

  //-------------------------------------------------------------------------------------  
}
