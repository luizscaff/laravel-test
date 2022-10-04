<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
  //-------------------------------------------------------------------------------------

  public function Index()
  {
    try
    {
      $list = Permission::orderBy('name')
                        ->get();

      return view('layouts.index.permissions', compact('list'));
    }
    catch(Exception $e)
    {
      Log::error("[PermissionController][Index]: " . $e);
    }
  }

  //-------------------------------------------------------------------------------------

  public function Create()
  {
    try
    {
      return view('layouts.edit.permissions');
    }
    catch(Exception $e)
    {
      Log::error("[PermissionController][Create]: " . $e);
    }
  }

  //-------------------------------------------------------------------------------------

  public function Edit($idPermission)
  {
    try
    {
      $item = Permission::findOrFail($idPermission);

      return view('layouts.edit.permissions', compact('item'));
    }
    catch(Exception $e)
    {
      Log::error("[PermissionController][Edit]: " . $e);
    }
  }

  //-------------------------------------------------------------------------------------

  public function Store(PermissionRequest $request)
  {
    if($request->validated())
      return $this->Save($request);
  }

  //-------------------------------------------------------------------------------------

  public function Update(PermissionRequest $request, $idPermission)
  {
    if($request->validated())
      return $this->Save($request, $idPermission);
  }

  //-------------------------------------------------------------------------------------

  private function Save(PermissionRequest $request, $idPermission = null)
  {
    try
    {
      $isStore = $idPermission == null;

      if($isStore)
        $permission = new Permission();
      else
        $permission = Permission::findOrFail($idPermission);

      $permission->name  = $request["name"];
      $permission->route = $request["route"];

      $permission->save();

      if($isStore)
        return back()->withMessage('Registro criado com sucesso');
      else
        return back()->withMessage('Registro atualizado com sucesso');
    }
    catch(Exception $e)
    {
      Log::error("[PermissionController][Save]: " . $e);
      return back()->withError('Houve uma exceção.');
    }
  }

  //-------------------------------------------------------------------------------------

  public function Destroy($idPermission)
  {
    try
    {
      $permission = Permission::findOrFail($idPermission)
                              ->delete();

      return back()->withMessage("Permissão excluída com sucesso.");
    }
    catch(Exception $e)
    {
      Log::error("[PermissionController][Delete]: " . $e);
      return back()->withError("Houve uma exceção.");
    }
  }

  //-------------------------------------------------------------------------------------
}
