<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Lumen_api;
use App\User;

class UserController extends Controller
{
    public function index(){
      echo "UserController@index()<br>";
      $results = DB::select("SELECT * FROM lumen_user ");
      print_r($results);

    }

    //
}
