<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  use HasFactory;

  protected $primaryKey = 'id_permission';

  //-------------------------------------------------------------------------------------

  protected static function boot()
  {
    parent::boot();

    static::deleting(function($permission)
    {
      foreach($permission->UserPermissions as $userPermission)
        $userPermission->delete();
    });
  }

  //-------------------------------------------------------------------------------------

  public function UserPermissions()
  {
    return $this->hasMany(UserPermission::Class, 'id_permission');
  }

  //-------------------------------------------------------------------------------------
}
