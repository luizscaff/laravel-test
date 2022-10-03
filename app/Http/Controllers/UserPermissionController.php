<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPermission;

class UserPermissionController extends Controller
{
  //-------------------------------------------------------------------------------------

  public static function Handle(User $user, $listOfPermissions = null)
  {
    $idPermissions = UserPermission::select('id_permission')
                                    ->where('id_user', $user->id)
                                    ->get();
    $arrayIdPermissions = $idPermissions->pluck('id_permission')->toArray();

    if($listOfPermissions == null || $user->is_admin) //admin não pode ter permissões
    {
      foreach($idPermissions as $permission)
        self::Delete($user->id, $permission->id_permission);
    }
    else
    {
      $toCreate = array_diff($listOfPermissions, $arrayIdPermissions);
      $toDelete = array_diff($arrayIdPermissions, $listOfPermissions);
  
      if(count($toCreate) > 0)
      {
        foreach($toCreate as $idPermission)
          self::Save($user->id, $idPermission);
      }
  
      if(count($toDelete) > 0)
      {
        foreach($toDelete as $idPermission)
          self::Delete($user->id, $idPermission);
      }
    }
  }

  //-------------------------------------------------------------------------------------

  private static function Save($idUser, $idPermission)
  {
    $userPermission = new UserPermission();
    $userPermission->id_permission = $idPermission;
    $userPermission->id_user       = $idUser;
    $userPermission->save();
  }

  //-------------------------------------------------------------------------------------

  private static function Delete($idUser, $idPermission)
  {
    $userPermission = UserPermission::where('id_permission', $idPermission)
                                    ->where('id_user', $idUser)
                                    ->delete();
  }

  //-------------------------------------------------------------------------------------
}
