<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $primaryKey = 'dept_id';
    
    protected $fillable = [
            'dept_name',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
    	];
}
