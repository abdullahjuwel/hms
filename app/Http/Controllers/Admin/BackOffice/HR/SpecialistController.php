<?php

namespace App\Http\Controllers\Admin\BackOffice\HR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Model\Specialist;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ResponseController as ResponseController;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class SpecialistController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.backoffice.hr.specialist.index');
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
            'spec_name'=>'required|unique:specialists',
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
            unset($input['_token'],$input['hidden_spec_id']);
            Specialist::firstOrCreate($input);
            $msg = 'Specialist Added Successfully!';
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
        $specialists = Specialist::find($id);
        if(count($specialists) > 0){
            return json_encode($specialists);
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
            'spec_name'       =>'required',
            'hidden_spec_id'  =>'required',
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
            $specialist = Specialist::find($id);
            if($specialist){
                $input = $request->all();
                $input = Arr::add($input, 'status',0);
                unset($input['_token'],$input['hidden_spec_id']);
                $specialist->where('spec_id',$id)->update($input);
                $msg = 'Specialist Updated Successfully!';
                return $this->respondWithSuccess($msg,$input,200);
            }else{
                $msg = 'Specialist Not Found!';
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
    public function specDatatableAjax(Request $req){
        $columns = array(
          0 => 'spec_id',
          1 => 'spec_name',
      );
        $totalData     = Specialist::count();
        $totalFiltered = $totalData; 

        $limit       = $req->get('length');
        $start       = $req->get('start');
        // $order       = $columns[$req->get('order')];
        $dir         = $req->get('order.0.dir');
        $search_arr  = $req->get('search');
        $search      = $search_arr['value'];

        if(empty($search))
        {
            $specialists = Specialist::offset($start)
            ->limit($limit)
            ->orderBy('created_at','desc')
            ->get();
        }
        else
        {
            $specialists = Specialist::where('spec_name', 'like', '%' . $search . '%')
            ->offset($start)
            ->limit($limit)
            ->orderBy('created_at','desc')
            ->get();

            $totalFiltered = Department::where('spec_name', 'like', '%' . $search . '%')
            ->count();
        }
        $data = array();
        if($specialists)
        {
            $sl = 0;
            foreach($specialists as $type)
            {
                $nestedData['sl']        = ++$sl;
                $nestedData['spec_name']     = $type->spec_name;
                $nestedData['status'] = $type->status == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
                $nestedData['created_at']     = date($type->created_at);
                $nestedData['actions']   = "<a data-toggle='modal' data-target='#spec_modal' data-backdrop='static' data-keyboard='false' class='btn-primary btn btn-rounded' onclick='get({$type->spec_id})' style='padding:0px 4px;' href='#'><i class='fa fa-edit'></i></a>
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
