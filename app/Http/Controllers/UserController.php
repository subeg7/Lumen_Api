<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\lumen_user;
use App\User;

class UserController extends Controller
{
    public function index(){
      echo "lumen users are:<br>";
      $results = lumen_user::all();
      $i=0;
      foreach($results as $row){
        echo $i."]. name=".$row->email."<br>";
        $i++;

      }

    }


}
