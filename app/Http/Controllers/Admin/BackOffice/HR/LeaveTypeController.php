<?php

namespace App\Http\Controllers\Admin\BackOffice\HR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Model\LeaveType;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ResponseController as ResponseController;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class LeaveTypeController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.backoffice.hr.leave_type.index');
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
            'leavetype_name'=>'required|unique:leave_types',
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
            unset($input['_token'],$input['hidden_id']);
            LeaveType::firstOrCreate($input);
            $msg = 'Leave Type Added Successfully!';
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
        $leave_types = LeaveType::find($id);
        if(count($leave_types) > 0){
            return json_encode($leave_types);
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
            'leavetype_name' =>'required',
            'hidden_id'      =>'required',
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
            $leave_type = LeaveType::find($id);
            if($leave_type){
                $input = $request->all();
                $input = Arr::add($input, 'status',0);
                unset($input['_token'],$input['hidden_id']);
                $leave_type->where('leavetype_id',$id)->update($input);
                $msg = 'Leave Type Updated Successfully!';
                return $this->respondWithSuccess($msg,$input,200);
            }else{
                $msg = 'Leave Type Not Found!';
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
    public function leaveTypeDatatableAjax(Request $req){
        $columns = array(
          0 => 'leavetype_id',
          1 => 'leavetype_name',
      );
        $totalData     = LeaveType::count();
        $totalFiltered = $totalData; 

        $limit       = $req->get('length');
        $start       = $req->get('start');
        // $order = $columns[$req->get('order.column')];
        $dir         = $req->get('order.0.dir');
        $search_arr  = $req->get('search');
        $search      = $search_arr['value'];

        if(empty($search))
        {
            $leave_types = LeaveType::offset($start)
            ->limit($limit)
                     // ->orderBy('desc',$dir)
            ->get();
        }
        else
        {
            $leave_types = LeaveType::where('leavetype_name', 'like', '%' . $search . '%')
            ->offset($start)
            ->limit($limit)
                            // ->orderBy('desc',$dir)
            ->get();

            $totalFiltered = LeaveType::where('leavetype_name', 'like', '%' . $search . '%')
            ->count();
        }
        $data = array();
        if($leave_types)
        {
            $sl = 0;
            foreach($leave_types as $type)
            {
                $editUrl                 = route('leave-type.edit',$type['leavetype_id']);
                $nestedData['sl']        = ++$sl;
                $nestedData['leavetype_name']     = $type->leavetype_name;
                $nestedData['status'] = $type->status == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
                $nestedData['actions']   = "<a data-toggle='modal' data-target='#leave_type' data-backdrop='static' data-keyboard='false' class='btn-primary btn btn-rounded' onclick='get({$type->leavetype_id})' style='padding:0px 4px;' href='#'><i class='fa fa-edit'></i></a>
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
