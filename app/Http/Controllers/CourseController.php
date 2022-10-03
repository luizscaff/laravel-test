<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
  //-------------------------------------------------------------------------------------

  public function Index()
  {
    try
    {
      \Session::flash('message', 'Acesso concedido!'); 

      return view('layouts.index.courses');
    }
    catch(Exception $e)
    {
      Log::error("[CourseController][Index]: " . $e);
    }
  }

  //-------------------------------------------------------------------------------------
}
