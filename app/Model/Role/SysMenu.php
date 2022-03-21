<?php

namespace App\Model\Role;

use Illuminate\Database\Eloquent\Model;

class SysMenu extends Model
{
    protected $table = 'sys_menu';

    protected $primaryKey = 'id';
    
    protected $fillable = [
    		'id',
            'parent_id',
            'url',
            'uri',
            'title',
            'alt_title',
            'description',
            'icon',
            'order',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
    	];
}
