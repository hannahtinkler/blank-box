<?php

namespace App\Library\Models;

use Illuminate\Database\Eloquent\Model;

class ServerPortForwardingSetting extends Model
{
    public $timestamps = false;
    
    public function server()
    {
        return $this->belongsTo('App\Library\Models\Server');
    }
}
