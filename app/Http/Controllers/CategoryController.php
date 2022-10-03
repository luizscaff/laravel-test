<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
  //-------------------------------------------------------------------------------------

  public function Index()
  {
    try
    {
      \Session::flash('message', 'Acesso concedido!'); 

      return view('layouts.index.categories');
    }
    catch(Exception $e)
    {
      Log::error("[CategoryController][Index]: " . $e);
    }
  }

  //-------------------------------------------------------------------------------------
}
