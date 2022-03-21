<?php

namespace App\Http\Controllers\Admin\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role\SysMenu;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Http\Controllers\ResponseController as ResponseController;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class MenuController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){ 
    	$menus = SysMenu::get()->pluck('title','id');
        $routes = \Route::getRoutes();
        $all_routes = [];
        foreach($routes as $key=>$route){
            if(in_array('GET',$route->methods)&&
                ((is_array($route->action['middleware'])&&in_array('RoleBuzz',$route->action['middleware']))||
                (!is_array($route->action['middleware'])&&$route->action['middleware']=='RoleBuzz'))
            )
            $all_routes[$route->uri]=$route->uri;
        }
        return view('admin.role.menu.index',compact('menus','all_routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules = array(
            'parent_id'=>'integer|nullable',
            'title'=>'required',
            'icon'=>'required|max:100',
            'status'=>'integer',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $errors = $validator->messages()->toArray();
            $msg = 'Validation Error';
            return $this->respondWithError($msg,$errors,422);
        }
        else
        {
            $input = $request->all();
            $input = Arr::add($input, 'status',1);
            unset($input['_token'],$input['example1_length'],$input['id']);
            SysMenu::firstOrCreate($input);
            $msg = 'Menu Added Successfully!';
            return $this->respondWithSuccess($msg,$data='',200);
        }
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
        $menu = SysMenu::find($id);
        return json_encode($menu);
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
        $rules = array(
            'parent_id'=>'integer|nullable',
            'title'=>'required',
            'icon'=>'required|max:100',
            'status'=>'integer',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $errors = $validator->messages()->toArray();
            $msg = 'Validation Error';
            return $this->respondWithError($msg,$errors,422);
        }
        else
        {
            $input = $request->all();
            $input = Arr::add($input, 'status',0);
            unset($input['_token'],$input['example1_length']);
            SysMenu::where('id',$id)->update($input);
            $msg = 'Menu Updated Successfully!';
            return $this->respondWithSuccess($msg,$input,200);
        }
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
    public function menuDatatableAjax(Request $req)
    {

        $columns = array(
          0 => 'title',
          1 => 'alt_title',
          2 => 'url',
          3 => 'actions'
      );
        $totalData     = SysMenu::count();
        $totalFiltered = $totalData; 

        $limit       = $req->get('length');
        $start       = $req->get('start');
        // $order = $columns[$req->get('order.column')];
        $dir         = $req->get('order.0.dir');
        $search_arr  = $req->get('search');
        $search      = $search_arr['value'];

        if(empty($search))
        {
            $menus = SysMenu::offset($start)
            ->limit($limit)
                     // ->orderBy('desc',$dir)
            ->get();
        }
        else
        {
            $menus = SysMenu::where('title', 'like', '%' . $search . '%')
            ->orWhere('alt_title', 'like', '%' . $search . '%')
            ->orWhere('url', 'like', '%' . $search . '%')
            ->offset($start)
            ->limit($limit)
                            // ->orderBy('desc',$dir)
            ->get();

            $totalFiltered = SysMenu::where('title', 'like', '%' . $search . '%')
            ->orWhere('alt_title', 'like', '%' . $search . '%')
            ->orWhere('url', 'like', '%' . $search . '%')
            ->count();
        }
        $data = array();
        if($menus)
        {
        	$sl = 0;
            foreach($menus as $menu)
            {
                $editUrl                 = route('menu.edit',$menu['id']);
                $nestedData['sl']        = ++$sl;
                $nestedData['title']     = $menu->title;
                $nestedData['alt_title'] = $menu->alt_title;
                $nestedData['url']       = $menu->url;
                $nestedData['icon']      = "<i style='color:gray;' class='{$menu->icon}'></i>";
                $nestedData['actions']   = "<a class='btn-primary btn btn-rounded' id='edit' data-id='".$menu->id."' style='padding:0px 4px;' href='#'><i class='fa fa-edit'></i></a>
                ";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
         "draw"                 => intval($req->get('draw')),
         "iTotalRecords"        => intval($totalData),
         'iTotalDisplayRecords' => intval($totalFiltered),
         'limit'                => $limit,
         "aaData"               => $data
     );

        echo json_encode($json_data);
    }
    
}
