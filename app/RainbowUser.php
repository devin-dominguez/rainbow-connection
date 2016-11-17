<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RainbowUser extends Model
{
  protected $fillable = ['first_name', 'last_name', 'color'];

  public static $rules = [
    'first_name' => 'required|min:3|max:80|Alpha',
    'last_name' => 'required|min:3|max:80|Alpha',
    'color' => 'required|Integer|min:0|max:11'
  ];
}
