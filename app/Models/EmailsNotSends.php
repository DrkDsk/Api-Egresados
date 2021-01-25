<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailsNotSends extends Model
{
    protected $fillable = ['tramite_id','destino','mensaje','fecha','hora'];


    public function FunctionName(Type $var = null)
    {
        # code...
    }
}
