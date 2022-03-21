<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $primaryKey = 'patient_id';
    
    protected $fillable = [
            'name',
            'guardian_name',
            'dob',
            'phone',
            'email',
            'blood_group',
            'gender',
            'address',
            'image',
            'marital_status',
            'tpa_id',
            'tpa_validity',
            'allergy',
            'nid',
            'remarks',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
    	];
}
