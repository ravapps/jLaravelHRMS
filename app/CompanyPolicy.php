<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyPolicy extends Model
{
    protected $fillable = [
        'branch',
        'title',
        'created_by'
    ];

    public function branches()
    {
        return $this->hasOne('App\Branch', 'id', 'branch');
    }
    public function department()
    {
        return $this->hasOne('App\Department', 'id', 'branch');
    }
}
