<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class lumen_user extends Model{

    protected $table = 'lumen_user';

    protected $fillable = array(
        'id',
        'name',
        'email',
        'password',
        'api-key',
    );
}
