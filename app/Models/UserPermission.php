<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
  use HasFactory;

  protected $primaryKey = 'id_user_permission';

  //-------------------------------------------------------------------------------------

  public function Permission()
  {
    return $this->belongsTo(Permission::Class, 'id_permission');
  }

  //-------------------------------------------------------------------------------------
}
