<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaders extends Model
{
    protected $table = 'leaders';
    protected $fillable = [
    	'name', 'picture', 'office'
    ];
}
