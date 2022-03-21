<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $table = 'leave_types';

    protected $primaryKey = 'leavetype_id';
    
    protected $fillable = [
            'leavetype_name',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
    	];
}
