<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
  //-------------------------------------------------------------------------------------

  public function Index()
  {
    try
    {
      \Session::flash('message', 'Acesso concedido!'); 

      return view('layouts.index.files');
    }
    catch(Exception $e)
    {
      Log::error("[FileController][Index]: " . $e);
    }
  }

  //-------------------------------------------------------------------------------------
}
