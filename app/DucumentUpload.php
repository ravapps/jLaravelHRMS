<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DucumentUpload extends Model
{
    protected $fillable = [
        'name',
        'role',
        'created_by'
    ];
    
}
