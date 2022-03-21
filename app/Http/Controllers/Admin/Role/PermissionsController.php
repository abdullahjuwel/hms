<?php

namespace App\Http\Controllers\Admin\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role\SysUserGroup;
use Illuminate\Support\Facades\Cache;
use App\Model\Role\SysGroupPermissions;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.role.permissions.index',['users'=>SysUserGroup::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function buildPermission($id){
        $routes = \Route::getRoutes();
        $group = SysUserGroup::findOrFail($id);
        foreach($routes as $key=>$route){
            $all_routes[]=[
                'uri'=>$route->uri,
                'methods'=>$route->methods,
                'action'=>$route->action,
            ];
        }
        $user_group_permissions = new SysGroupPermissions();
        $user_group_permissions=$user_group_permissions->where(['sys_group_id'=>$id])->get()->toArray();
        return view('admin.role.permissions.build_permission',compact('user_group_permissions','id','routes','group'));
    }
    public function setPermission(Request $request,$id){
        $user_group_permissions = new SysGroupPermissions();
        $user_group_permissions->where(['sys_group_id'=>$id])->delete();
        $validatedData = $this->validate($request,[
            'routes.*.uri' => 'required',
            'routes.*.http_verbs' => 'required'
        ]);
        $inputs = $request->routes;
        foreach ($inputs as $key=>&$input){
            if(!isset($input['checked']))
                unset($inputs[$key]);
            else{
                unset($input['checked']);
                $input['sys_group_id'] = $id;
            }
        }
        SysGroupPermissions::insert($inputs);
        Cache::forget(config('sys.role_cache'));
        $usr_groups = SysUserGroup::pluck('name','id');
        foreach ($usr_groups as $group_id=>$value)
        Cache::forget(config('sys.role_cache').'_'.$group_id);
        $request->session()->flash('success', __('Permission has been saved Successfully'));
        return redirect()->route('permissions');
    }
}
