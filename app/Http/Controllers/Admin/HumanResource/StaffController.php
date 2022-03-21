<?php

namespace App\Http\Controllers\Admin\HumanResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\User;
use Image;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ResponseController as ResponseController;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class StaffController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.humanresource.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_groups    = getUserGroups();
        $designations   = getDesignations();
        $departments    = getDepartments();
        $specialists    = getSpecialists();
        $marital_status = getMaritalStatus();
        $blood_groups   = getBloodGroup();
        return view('admin.humanresource.staff.create',compact('user_groups','designations','specialists','marital_status','blood_groups','departments'));
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
            'staff_id'        => 'required|unique:users',
            'sys_group_id'    => 'required',
            'desig_id'        => 'required',
            'dept_id'         => 'required',
            'spec_ids'        => 'required',
            'first_name'      => 'required',
            'father_name'     => 'required',
            'mother_name'     => 'required',
            'date_of_joining' => 'required',
            'current_address' => 'required',
            'dob'             => 'required',
            'blood_group'     => 'required',
            'phone'           => 'required|unique:users',
            'email'           => 'required|unique:users',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid'             => 'required',
            'basic_salary'    => 'required',
            'acc_no'          => 'required',
            'resume'          => 'mimes:doc,pdf,docx,zip|max:1024',
            'joining_letter'  => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx,zip|max:1024',
            'other_document'  => 'mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx,zip|max:1024'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $errors = $validator->messages()->toArray();
            $msg = 'Validation Error';
            return $this->respondWithError($msg,$errors,422);
        }else{
            $input = $request->all();
            $img_filename = '';

        if($request->hasFile('image')){
            $image        = $request->file('image');
            $img_filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(100, 100)->save( public_path('assets/images/' . $img_filename));
        }

            $resume                  = $this->file($request,'resume');
            $joining_letter          = $this->file($request,'joining_letter');
            $other_document          = $this->file($request,'other_document');

            $input['image']          = $img_filename;
            $input['resume']         = $resume;
            $input['joining_letter'] = $joining_letter;
            $input['other_document'] = $other_document; 

            $input['username']       = $request->get('email');
            $input['name']           = $request->get('first_name').' '.$request->get('last_name');
            
            $newstring               = substr($request->get('phone'), -4);
            $password                = $newstring.rand(100,999);
            $password_hash           = Hash::make($password);
            $input['password']       = $password_hash;
            $input['created_by']     = auth()->user()->id;
            unset($input['_token'],$input['spec_ids'],$input['first_name'],$input['last_name']);
            User::firstOrCreate($input);
            Mail::to($request->get('email'))->send(new SendMail($password));
            $msg = 'Staff Enrollment Successfull!';
            return $this->respondWithSuccess($msg,$input,200);
        }
    }

    private function file($request,$fieldname){
        $db_filename = '';
        if($request->hasFile($fieldname)){
            $file = $request->file($fieldname);
            $db_filename = time() .'_'.$request->get('first_name').'_'.$fieldname.'.' . $file->getClientOriginalExtension();
            $file->move('public/assets/files/',$db_filename);
          }
          return $db_filename;
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
    public function staffDataAjax(Request $request){
        $staffs = User::select()
                   ->where('status',1)
                   ->with(['role'])
                   ->get();
        if(count($staffs) > 0){
            $msg = 'All Staffs!';
            return $this->respondWithSuccess($msg,$staffs,200);
        }else{
            $msg = 'No record found!';
            return $this->respondWithSuccess($msg,$staffs='',404);
        }
    }
    public function staffProfile(Request $request, $staff_id){
        $data = User::where('staff_id',$staff_id)->get()->toArray();
        if(count($data) > 0){
            $staff_data = $data[0];
            return view('admin.humanresource.staff.profile',compact('staff_data'));
        }else{
            return redirect()->back();
        }
    }
}
