<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
 
class Edoc extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getConnectionName()
    {
        return Session::get('db_connection', 'mysql'); // Default to 'mysql' if not set
    }

    protected $fillable = [
        'control_number',
        'reference_number',
        'type_id',
        'company_id',
        'department_id',
        'user_id',
        'revision_number',
        'file_name',
        'path',
        'date_effectivity',
        'title',
        'remarks',
        'status',
        'confidential',
    ];

    public function type() {
        return $this->belongsTo('App\Models\Type');
    }

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }

    public function department() {
        return $this->belongsTo('App\Models\Department');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
