<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Models\User;

use Auth;
use DB;
use Hash;
use Log;

class UserController extends Controller
{
  //-------------------------------------------------------------------------------------

  public function Index()
  {
    try
    {
      $list = User::orderBy('name')
                  ->get();

      return view('layouts.index.users', compact('list'));
    }
    catch(Exception $e)
    {
      Log::error("[UserController][Index]: " . $e);
    }
  }

  //-------------------------------------------------------------------------------------

  public function Create()
  {
    try
    {
      $listPermission = Permission::orderBy('name')
                                  ->get();

      return view('layouts.edit.users', compact('listPermission'));
    }
    catch(Exception $e)
    {
      Log::error("[UserController][Create]: " . $e);
    }
  }

  //-------------------------------------------------------------------------------------

  public function Edit($idUser)
  {
    try
    {
      $item = User::with(['UserPermissions'])
                  ->findOrFail($idUser);
      $listPermission = Permission::orderBy('name')
                                  ->get();

      return view('layouts.edit.users', compact('item', 'listPermission'));
    }
    catch(Exception $e)
    {
      Log::error("[UserController][Edit]: " . $e);
    }
  }

  //-------------------------------------------------------------------------------------

  public function Store(UserRequest $request)
  {
    if($request->validated())
      return $this->Save($request);
  }

  //-------------------------------------------------------------------------------------

  public function Update(UserRequest $request, $idUser)
  {
    if($request->validated())
      return $this->Save($request, $idUser);
  }

  //-------------------------------------------------------------------------------------

  private function Save(UserRequest $request, $idUser = null)
  {
    try
    {
      return DB::transaction(function() use($request, $idUser)
      {
        $isStore = $idUser == null;

        if($isStore)
          $user = new User();
        else
          $user = User::findOrFail($idUser);

        $user->name  = $request["name"];
        $user->email = $request["email"];

        if(isset($request["password"]) && strlen($request["password"]) > 0)
          $user->password = Hash::make($request["password"]);

        if(isset($request["is_admin"]) && $request["is_admin"] == 1)
          $user->is_admin = true;
        else
          $user->is_admin = false;

        $user->save();

        UserPermissionController::Handle($user, $request["id_permission"]);  

        if($isStore)
          return back()->withMessage('Registro criado com sucesso');
        else
          return back()->withMessage('Registro atualizado com sucesso');
      });
    }
    catch(Exception $e)
    {
      Log::error("[UserController][Save]: " . $e);
      return back()->withError('Houve uma exce????o.');
    }
  }

  //-------------------------------------------------------------------------------------

  public function Destroy($idUser)
  {
    try
    {
      if(Auth::user()->id == $idUser)
        return back()->withError("N??o ?? poss??vel excluir a si mesmo.");

      $user = User::findOrFail($idUser)
                  ->delete();

      return back()->withMessage("Usu??rio exclu??do com sucesso.");
    }
    catch(Exception $e)
    {
      Log::error("[UserController][Delete]: " . $e);
      return back()->withError("Houve uma exce????o.");
    }
  }

  //-------------------------------------------------------------------------------------
}
