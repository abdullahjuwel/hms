
<div class="box-header" style="background-color:#56c8f5;">
  <h3 class="box-title" style="color: white;"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;Basic Information</h3>
  <a><button id="iconChange" class="pull-right" type="submit"><i class="fa fa-check-circle"></i></button></a>
</div>

<div class="col-md-6 no-padding">

  <div class="box-body" style="padding: 4px;">
    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Staff ID</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="staff_id" id="staff_id" placeholder="Enter staff identification number">
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Role</label>
      <div class="col-sm-3">
        <select class="form-control select2" name="sys_group_id" id="sys_group_id" style="width: 100%;">
          <option value="" disabled="" selected="">- - - Select - - -</option>
          @if(!empty($user_groups))
          @foreach($user_groups as $sys_group_id => $user_group)
          <option value="{{ $sys_group_id }}">{{ $user_group }}</option>
          @endforeach
          @endif
        </select>
      </div>
      <label for="inputPassword3" class="col-sm-2 control-label">Designation</label>
      <div class="col-sm-4">
        <select class="form-control select2" name="desig_id" id="desig_id" style="width: 100%;">
          <option value="" disabled="" selected="">- - - Select - - -</option>
          @if(!empty($designations))
          @foreach($designations as $desig_id => $desig_name)
          <option value="{{ $desig_id }}">{{ $desig_name }}</option>
          @endforeach
          @endif
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Department</label>
      <div class="col-sm-9">
        <select class="form-control select2" name="dept_id" id="dept_id" style="width: 100%;">
          <option value="" disabled="" selected="">- - - Select - - -</option>
          @if(!empty($departments))
          @foreach($departments as $dept_id => $dept_name)
          <option value="{{ $dept_id }}">{{ $dept_name }}</option>
          @endforeach
          @endif
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Specialist</label>
      <div class="col-sm-9">
        <select class="form-control select2" name="spec_ids[]" data-placeholder="  - - -Select- - -" id="spec_ids" style="width: 100%;" multiple>
          @if(!empty($specialists))
          @foreach($specialists as $spec_id => $spec_name)
          <option value="{{ $spec_id }}">{{ $spec_name }}</option>
          @endforeach
          @endif
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">First Name</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" value="" name="first_name" id="first_name" placeholder="Enter first name">
      </div>
      <label for="inputPassword3" class="col-sm-2 control-label">Last Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" value="" name="last_name" id="last_name" placeholder="Enter last name">
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Father's Name</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" value="" name="father_name" id="father_name" placeholder="Enter father's name">
      </div>
      <label for="inputPassword3" class="col-sm-2 control-label">Mother's Name</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" value="" name="mother_name" id="mother_name" placeholder="Enter mother's name">
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Marital Status</label>
      <div class="col-sm-3">
        <select class="form-control select2" name="marital_status" id="marital_status" style="width: 100%;">
          <option value="" disabled="" selected="">- - - Select - - -</option>
          @if(!empty($marital_status))
          @foreach($marital_status as $key => $status)
          <option value="{{ $key }}">{{ $status }}</option>
          @endforeach
          @endif
        </select>
      </div>
      <label for="inputPassword3" class="col-sm-2 control-label">Gender</label>
      <div class="col-sm-4">
        <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
          <option value="" disabled="" selected="">- - - Select - - -</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Date Of Joining</label>
      <div class="col-sm-9">
        <input type="date" class="form-control" value="" name="date_of_joining" id="date_of_joining" placeholder="Enter first name">
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Current Address</label>
      <div class="col-sm-9">
        <textarea class="form-control" rows="2" name="current_address" id="current_address" placeholder="Enter current address"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Permanent Address</label>
      <div class="col-sm-9">
        <textarea class="form-control" rows="2" name="perma_address" id="perma_address" placeholder="Enter permanent address"></textarea>
      </div>
    </div>

    <!-- <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Picture</label>
      <div class="col-sm-9">
        <input onchange="readURL(this);" style="background-color: lavender;" type="file" class="form-control" name="AssetImage" id="AssetImage">
      </div>
    </div> -->

  </div>
</div>

<div class="box-body no-padding">
  <div class="col-md-6 no-padding">
    <div class="box-body" style="padding: 4px;">

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">Date Of Birth</label>
        <div class="col-sm-3">
          <input type="date" class="form-control" value="" name="dob" id="dob" placeholder="Enter mother's name">
        </div>
        <label for="inputPassword3" class="col-sm-2 control-label">Blood Group</label>
        <div class="col-sm-4">
          <select class="form-control select2" name="blood_group" id="blood_group" style="width: 100%;">
            <option value="" disabled="" selected="">- - - Select - - -</option>
            @if(!empty($blood_groups))
            @foreach($blood_groups as $key => $blood_group)
            <option value="{{ $key }}">{{ $blood_group }}</option>
            @endforeach
            @endif
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">Phone</label>
        <div class="col-sm-3">
          <input type="number" class="form-control" value="" name="phone" id="phone" placeholder="Enter mobile">
        </div>
        <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" value="" name="email" id="email" placeholder="Enter email">
        </div>
      </div>

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">Staff Photo</label>
        <div class="col-sm-9">
          <input type="file" onchange="readURL(this);" class="form-control" value="" name="image" id="image" placeholder="Enter staff image">
        </div>
      </div>

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">Image Preview</label>
        <div class="col-sm-3">
          <img id="uploaded_image" src="{{ asset('public/assets/images/avatar.png') }}" class=" img-responsive img-square img-lg" alt="Staff Image">
        </div> 
        <label for="inputPassword3" class="col-sm-2 control-label">Work Experience</label>
        <div class="col-sm-4">
          <textarea class="form-control" rows="4" name="experience" id="experience" placeholder="Enter work experience"></textarea>
        </div>
      </div>

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">Qualification</label>
        <div class="col-sm-9">
         <textarea class="form-control" rows="2" name="qualification" id="qualification" placeholder="Enter qualification"></textarea>
       </div>
     </div>

     <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Specialization</label>
      <div class="col-sm-9">
        <textarea class="form-control" rows="2" name="specialization" id="specialization" placeholder="Enter specialization"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">National ID Number</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="nid" id="nid" placeholder="Enter national identification no">
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Reference Contact</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" value="" name="reference_contact" id="reference_contact" placeholder="Enter reference contact">
      </div>
    </div>

  </div>
</div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box-body no-padding">
      <div class="col-md-6 no-padding">
        <div class="box-header" style="background-color:#56c8f5;">
          <h3 class="box-title"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Payroll</h3>
        </div>
        <div class="box-body" style="padding: 4px;">

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">EPF Number</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" value="" name="epf_no" id="epf_no" placeholder="Enter epf number">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Basic Salary</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="basic_salary" id="basic_salary" placeholder="Enter basic salary">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Work Shift</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" value="" name="work_shift" id="work_shift" placeholder="Enter working shift">
            </div>
            <label for="inputPassword3" class="col-sm-2 control-label">Work Location</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" value="" name="work_location" id="work_location" placeholder="Enter work location">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Contract Type</label>
            <div class="col-sm-9">
             <select class="form-control select2" name="contract_type" id="contract_type" style="width: 100%;">
              <option value="" selected="selected">- - - Select - - -</option>
              <option value="1">{{ __('Permanent') }}</option>
              <option value="1">{{ __('Probation') }}</option>
             </select>
            </div>
          </div>

        </div>
      </div>

    <div class="col-md-6 no-padding">
      <div class="box-header" style="background-color:#56c8f5;">
        <h3 class="box-title"><i class="fa fa-cubes"></i>&nbsp;&nbsp;Leaves</h3>
      </div>
      <div class="box-body" style="padding: 4px;">

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Casual Leave</label>
          <div class="col-sm-3">
            <input type="number" class="form-control" value="" name="casual_leave" id="casual_leave" placeholder="Enter no of casual leaves">
          </div>
          <label for="inputPassword3" class="col-sm-2 control-label">Privilege Leave</label>
          <div class="col-sm-4">
            <input type="number" class="form-control" value="" name="privilege_leave" id="privilege_leave" placeholder="Enter no of privilege leaves">
          </div>
        </div>

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Sick Leave</label>
          <div class="col-sm-3">
            <input type="number" class="form-control" value="" name="sick_leave" id="sick_leave" placeholder="Enter no of sick leaves">
          </div>
          <label for="inputPassword3" class="col-sm-2 control-label">Maternity Leave</label>
          <div class="col-sm-4">
            <input type="number" class="form-control" value="" name="maternity_leave" id="maternity_leave" placeholder="Enter no of maternity leaves">
          </div>
        </div>

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Paternity Leave</label>
          <div class="col-sm-3">
            <input type="number" class="form-control" value="" name="paternity_leave" id="paternity_leave" placeholder="Enter no of paternity leaves">
          </div>
          <label for="inputPassword3" class="col-sm-2 control-label">Fever Leave</label>
          <div class="col-sm-4">
            <input type="number" class="form-control" value="" name="fever_leave" id="fever_leave" placeholder="Enter no of fever leaves">
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="box-body no-padding">
      <div class="col-md-6 no-padding">
        <div class="box-header" style="background-color:#56c8f5;">
          <h3 class="box-title"><i class="fa fa-bank"></i>&nbsp;&nbsp;Bank Account Details</h3>
        </div>
        <div class="box-body" style="padding: 4px;">

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Account Title</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" value="" name="acc_title" id="acc_title" placeholder="Enter account title">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Bank Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter bank name">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Bank Account No.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" value="" name="acc_no" id="acc_no" placeholder="Enter bank account no">
            </div>
            <label for="inputPassword3" class="col-sm-2 control-label">IFSC Code</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" value="" name="ifsc_code" id="ifsc_code" placeholder="Enter ifsc code">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Bank Branch Name</label>
            <div class="col-sm-9">
             <input type="text" class="form-control" value="" name="bank_branch" id="bank_branch" placeholder="Enter bank branch name">
           </div>
         </div>

       </div>
     </div>

     <div class="col-md-6 no-padding">
      <div class="box-header" style="background-color:#56c8f5;">
        <h3 class="box-title"><i class="fa fa-facebook"></i>&nbsp;&nbsp;Social Media Link</h3>
      </div>
      <div class="box-body" style="padding: 4px;">

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Facebook URL</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" value="" name="fb_url" id="fb_url" placeholder="Enter facebook url">
          </div>
        </div>

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Linkedin URL</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" value="" name="linkedin_url" id="linkedin_url" placeholder="Enter linkedin url">
          </div>
        </div>

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Twitter URL</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" value="" name="twitter_url" id="twitter_url" placeholder="Enter twitter url">
          </div>
        </div>

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Instagram URL</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" value="" name="instagram_url" id="instagram_url" placeholder="Enter instagram url">
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box-body no-padding">
      <div class="col-md-6 no-padding">
        <div class="box-header" style="background-color:#56c8f5;">
          <h3 class="box-title"><i class="fa fa-file"></i>&nbsp;&nbsp;Upload Documents</h3>
        </div>
        <div class="box-body" style="padding: 4px;">

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Resume</label>
            <div class="col-sm-9">
              <input type="file" class="form-control" value="" name="resume" id="resume" placeholder="Enter resume">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Joining Letter</label>
            <div class="col-sm-9">
              <input type="file" class="form-control" name="joining_letter" id="joining_letter" placeholder="Enter joining letter">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Other Document</label>
            <div class="col-sm-9">
              <input type="file" class="form-control" value="" name="other_document" id="other_document" placeholder="Enter other document">
            </div>
          </div>

        </div>
      </div>

      <div class="col-md-6 no-padding">
        <div class="box-header" style="background-color:#56c8f5;">
          <h3 class="box-title"><i class="fa fa-wrench" style="color:#56c8f5;"></i></h3>
        </div>
      </div>

    </div>
  </div>
</div>