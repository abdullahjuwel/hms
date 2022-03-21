<?php

namespace App\Http\Controllers\Admin\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController as ResponseController;
use Illuminate\Support\Facades\Validator;
use Image;
use App\Model\Patient;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class PatientController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.backoffice.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules = array(
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'         =>'required',
            'guardian_name'=>'required',
            'dob'          =>'required',
            'blood_group'  =>'required',
            'address'      =>'required',
            'phone'        =>'required|unique:patients',
            'email'        =>'required',
            'nid'          =>'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            $errors = $validator->messages()->toArray();
            $msg = 'Validation Error';
            return $this->respondWithError($msg,$errors,422);
        }
        else{
            $input = $request->all();
            $filename = '';
            if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(400, 400)->save( public_path('assets/images/' . $filename));
          }
            $input['image'] = $filename;
            $input['created_by'] = auth()->user()->id;
            unset($input['_token'],$input['year'],$input['month'],$input['day']);
            Patient::firstOrCreate($input);
            $msg = 'Patient Enrollment Successfully Done!';
            return $this->respondWithSuccess($msg,$input,200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $patient = Patient::find($id);
        if(count($patient) > 0){
            $msg = 'Data found!';
            return $this->respondWithSuccess($msg,$patient,200);
        }else{
            $data = '';
            $msg = 'Validation Error!';
            return $this->respondWithError($msg,$data,404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
    public function patientDatatableAjax(Request $req){
        $columns = array(
          0 => 'patient_id',
          1 => 'name',
          2 => 'mobile',
          3 => 'email',
          4 => 'dob',
          5 => 'actions'
      );
        $totalData = Patient::count();
        $totalFiltered = $totalData; 

        $limit = $req->get('length');
        $start = $req->get('start');
        // $order = $columns[$req->get('order.column')];
        $dir   = $req->get('order.0.dir');
        $search_arr  = $req->get('search');
        $search    = $search_arr['value'];

        if(empty($search)){
            $patients = Patient::offset($start)
            ->limit($limit)
            ->orderBy('created_at','desc')
            ->get();
        }
        else{
            $patients = Patient::where('guardian_name', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->offset($start)
            ->limit($limit)
            ->orderBy('created_at','desc')
            ->get();

            $totalFiltered = Patient::where('guardian_name', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->count();
        }
        
        $data = array();
        if($patients){
            $sl = 0;
            foreach($patients as $patient){
                $imageURL                   = asset('assets/images/'.$patient->image);
                $editUrl                    = route('patient.edit',$patient['patient_id']);
                $nestedData['nid']          = $patient->nid;
                $nestedData['patient_id']   = $patient->patient_id;
                $nestedData['name']         = $patient->name;
                $nestedData['phone']        = $patient->phone;
                $nestedData['email']        = $patient->email;
                $nestedData['image']        = "<img src='{$imageURL}' class='profile-user-img img-responsive img-circle img-sm zoom' alt='Member Image'>";
                $nestedData['dob']          = $patient->dob;
                $nestedData['gender']       = $patient->gender;
                $nestedData['blood_group']  = $patient->blood_group;
                $nestedData['actions']      = "<a class='btn-primary btn btn-rounded' id='edit' data-id='".$patient->patient_id."' style='padding:0px 4px;' href='#'><i class='fa fa-edit'></i></a>
                <a class='btn-info btn btn-rounded' id='show' data-id='".$patient->patient_id."' style='padding:0px 4px;' data-toggle='modal' data-target='#patient_info_modal' data-backdrop='static' data-keyboard='false' href='#'><i class='fa fa-eye'></i></a>
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
