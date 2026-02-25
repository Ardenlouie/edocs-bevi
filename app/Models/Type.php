<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\Session;

class Type extends Model
{
    use HasFactory;


    protected $fillable = [
        'description',
        'prefix',
        'sequence',
        'record_year',
    ];

    public function getConnectionName()
    {
        return Session::get('db_connection', 'mysql'); // Default to 'mysql' if not set
    }

    public function edocs() {
        return $this->hasMany('App\Models\Edoc');
    }
}
