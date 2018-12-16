<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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

    // public


    public function post(Request $post){
      $users = lumen_user::all();
      $status = false;
      foreach($users as $user){
        if($post->email==$user->email && $post->password==$user->password){
          $status = true;
          break;
        }else $status = false;
      }

      if($status){
        return "you are succesfully logged in,token=".$this->ProvideApiToken();

      }
      else
        return "couldn't validate";


    }

    private function ProvideApiToken(){
      $charid = strtoupper(md5(uniqid(rand(),true)));
      $hypen = chr(45); //'-'
      $uuid = chr(123)//'{'
              .substr($charid,0,8).$hypen
              .substr($charid,8,4).$hypen
              .substr($charid,12,4).$hypen
              .substr($charid,16,4).$hypen
              .substr($charid,20,12)
              .chr(125);//'}'

      mt_srand((double)microtime()*10000);
      return $uuid;
    }



}
