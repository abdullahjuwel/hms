<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    protected $table = 'specialists';

    protected $primaryKey = 'spec_id';
    
    protected $fillable = [
            'spec_name',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
    	];
}
