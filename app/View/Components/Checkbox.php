<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
  public $field;
  public $item;

  public function __construct($field, $item)
  {
    $this->field = $field;
    $this->item  = $item;
  }

  public function render()
  {
      return view('components.checkbox');
  }
}