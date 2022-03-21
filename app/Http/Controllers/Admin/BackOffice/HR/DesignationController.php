<?php

namespace App\Http\Controllers\Admin\BackOffice\HR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Model\Designation;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ResponseController as ResponseController;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class DesignationController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.backoffice.hr.designation.index');
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
        $rules = array(
            'desig_name'=>'required|unique:designations',
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
            $input['created_by'] = auth()->user()->id;
            unset($input['_token'],$input['hidden_desig_id']);
            Designation::firstOrCreate($input);
            $msg = 'Designation Added Successfully!';
            return $this->respondWithSuccess($msg,$input,200);
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
        $designations = Designation::find($id);
        if(count($designations) > 0){
            return json_encode($designations);
        }else{
            return json_encode([]);
        }
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
            'desig_name'       =>'required',
            'hidden_desig_id'  =>'required',
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
            $designation = Designation::find($id);
            if($designation){
                $input = $request->all();
                $input = Arr::add($input, 'status',0);
                unset($input['_token'],$input['hidden_desig_id']);
                $designation->where('desig_id',$id)->update($input);
                $msg = 'Designation Updated Successfully!';
                return $this->respondWithSuccess($msg,$input,200);
            }else{
                $msg = 'Designation Not Found!';
                return $this->respondWithError($msg,$input='',404);
            }
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
    public function desigDatatableAjax(Request $req){
        $columns = array(
          0 => 'desig_id',
          1 => 'desig_name',
      );
        $totalData     = Designation::count();
        $totalFiltered = $totalData; 

        $limit       = $req->get('length');
        $start       = $req->get('start');
        // $order       = $columns[$req->get('order')];
        $dir         = $req->get('order.0.dir');
        $search_arr  = $req->get('search');
        $search      = $search_arr['value'];

        if(empty($search))
        {
            $designations = Designation::offset($start)
            ->limit($limit)
            ->orderBy('created_at','desc')
            ->get();
        }
        else
        {
            $designations = Designation::where('desig_name', 'like', '%' . $search . '%')
            ->offset($start)
            ->limit($limit)
            ->orderBy('created_at','desc')
            ->get();

            $totalFiltered = Department::where('desig_name', 'like', '%' . $search . '%')
            ->count();
        }
        $data = array();
        if($designations)
        {
            $sl = 0;
            foreach($designations as $type)
            {
                $editUrl                 = route('designation.edit',$type['desig_id']);
                $nestedData['sl']        = ++$sl;
                $nestedData['desig_name']     = $type->desig_name;
                $nestedData['status'] = $type->status == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
                $nestedData['created_at']     = date($type->created_at);
                $nestedData['actions']   = "<a data-toggle='modal' data-target='#desig_modal' data-backdrop='static' data-keyboard='false' class='btn-primary btn btn-rounded' onclick='get({$type->desig_id})' style='padding:0px 4px;' href='#'><i class='fa fa-edit'></i></a>
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
