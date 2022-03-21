<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'username', 
        'sys_group_id', 
        'staff_id', 
        'desig_id', 
        'dept_id', 
        'father_name', 
        'mother_name', 
        'marital_status', 
        'gender', 
        'date_of_joining', 
        'current_address', 
        'perma_address', 
        'dob', 
        'blood_group', 
        'phone', 
        'email', 
        'image', 
        'experience', 
        'qualification', 
        'specialization', 
        'nid', 
        'reference_contact', 
        'epf_no', 
        'basic_salary', 
        'work_shift', 
        'work_location', 
        'contract_type', 
        'casual_leave', 
        'privilege_leave', 
        'sick_leave', 
        'maternity_leave', 
        'paternity_leave', 
        'fever_leave', 
        'acc_title', 
        'bank_name', 
        'acc_no', 
        'ifsc_code', 
        'bank_branch', 
        'fb_url', 
        'linkedin_url', 
        'twitter_url', 
        'instagram_url', 
        'resume', 
        'joining_letter', 
        'other_document', 
        'password',
        'status',
        'created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    } 
    public function role()
    {
        return $this->hasOne('App\Model\Role\SysUserGroup','id','sys_group_id')
                    ->select('sys_user_groups.id','sys_user_groups.name');
    } 
}
