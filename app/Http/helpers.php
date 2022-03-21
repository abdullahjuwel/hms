<?php

use App\Model\Role\SysGroupPermissions;
use App\Model\Role\SysUserGroup;
use App\Model\Designation;
use App\Model\Department;
use App\Model\Specialist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

function formatTree($all_categories,$root_categories){       
    foreach ($root_categories as $key => $root) {
        $root->children = $all_categories->where('parent_id',$root->id);
        if($root->children){
            formatTree($all_categories,$root->children);
        }
    }
    return $root_categories;

}
if (! function_exists('getRoles')) {
    function getRoles(){
        if(!Cache::has(config('sys.role_cache'))){
            Cache::rememberForever(config('sys.role_cache'), function() {
                return SysGroupPermissions::all()->toArray();
            });
        }
        return Cache::get(config('sys.role_cache'));
    }
}
function buildChildParent($rows){
    $arrange_menus=[];
    foreach ($rows as $row)
    {
        $arrange_menus[$row['id']]=$row['parent_id'];
    }
    return $arrange_menus;
}
function getActiveNodes($array, $id){
    $ids[]=$id;
    while(!empty($array[$id]))
    {
        $ids[]=$array[$id];
        $id = $array[$id];
    }
   return $ids;
}
if (!function_exists('getBloodGroup')) {
    function getBloodGroup(){
        $bloodGroup = array(
            '1'     =>  'O+',
            '2'     =>  'O-',
            '3'     =>  'A+',
            '4'     =>  'A-',
            '5'     =>  'B+',
            '6'     =>  'B-',
            '7'     =>  'AB+',
            '8'     =>  'AB-',              
        );
        return $bloodGroup;
    }
}
if (!function_exists('getMaritalStatus')) {
    function getMaritalStatus(){
        $maritalStatus = array(
            '1'     =>  'Married',
            '2'     =>  'Unmarried',
            '3'     =>  'Widowed',
            '4'     =>  'Separated',
            '5'     =>  'Not Specified'             
        );
        return $maritalStatus;
    }
}
if (!function_exists('getUserGroups')) {
    function getUserGroups(){
        $userGroups = SysUserGroup::pluck('name','id');
        return $userGroups;
    }
}
if (!function_exists('getDesignations')) {
    function getDesignations(){
        $designations = Designation::where('status',1)->pluck('desig_name','desig_id');
        return $designations;
    }
}
if (!function_exists('getSpecialists')) {
    function getSpecialists(){
        $specialists = Specialist::where('status',1)->pluck('spec_name','spec_id');
        return $specialists;
    }
}
if (!function_exists('getDepartments')) {
    function getDepartments(){
        $departments = Department::where('status',1)->pluck('dept_name','dept_id');
        return $departments;
    }
}
