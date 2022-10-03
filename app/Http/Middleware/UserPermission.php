<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class UserPermission
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    if (!Auth::user() || Auth::user()->is_admin)
    {
      return redirect()->route("dashboard")->withError("Acesso negado.");
    }
    else if(Auth::user() && !Auth::user()->is_admin)
    {
      $pathInfo   = $request->getPathInfo();
      $routeArray = array_values(array_filter(explode("/", $pathInfo)));
      $route = null;

      if(count($routeArray) > 0)
        $route = $routeArray[0];

      //busca por uma rota correspondente à rota corrente no banco de dados
      $modelHasRoute = \App\Models\Permission::where('route', $route)->count();

      //caso não exista uma rota correspondente no banco de dados, o acesso é liberado
      if($modelHasRoute < 1)
        return $next($request);

      //busca um registro na tabela de relação UserPermission que corresponda à rota e ao usuário correntes
      $userAccess = \App\Models\UserPermission::with(['Permission'])
                                              ->where('id_user', Auth::user()->id)
                                              ->whereHas('Permission', function($query) use($route)
                                              {
                                                $query->where('route', $route);
                                              })
                                              ->count();

      if($userAccess > 0)
        return $next($request);
      else
        return redirect()->route("dashboard")->withError("Acesso negado. Entre em contato com o administrador.");
    }
    else
    {
      return $next($request);
    }
  }
}
