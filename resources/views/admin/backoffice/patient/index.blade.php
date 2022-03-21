@extends('layouts.admin')
@section('content')
<style type="text/css">
  th{
   background-color: #0689bd;
   color: white;
 }
 .box-body{
   background-color: white;
 }
 .box-title{
  color: white;
}
.box-header{
  /*background-color:#105e7d;*/
}
</style>

<form class="form-horizontal form_submit" method="POST" autocomplete="off">
  {{ csrf_field() }}
  <section class="content">
    <div class="col-xs-12 no-padding">
      <div class="box-header">
        <h3 class="box-title" style="color: grey;"><i class="fa fa-wheelchair"></i>&nbsp;&nbsp; All Patient Information</h3>
        <a href="#"><button data-toggle="modal" data-target="#patient" data-backdrop="static" data-keyboard="false" class="pull-right" type="button"><i class="glyphicon glyphicon-plus-sign"></i></button></a>
      </div>
      <div class="box-body table-responsive">
        <table id="patient_datatable" class="table table-bordered text-center" width="100%">
          <thead>
            <tr>
              <th>NID</th>
              <th>Patient ID</th>
              <th>Name</th>
              <th>Mobile</th>
              <th>Email</th>
              <th>Image</th>
              <th>Gender</th>
              <th>Blood Group</th>
              <th>DOB</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</form>
@include('admin.backoffice.patient.add_modal')
@include('admin.backoffice.patient.show_modal')
@endsection

@section('extra_script')
<script type="text/javascript">
  "use strict";
  var KTDatatablesDataSourceAjaxServer = function() {
    var initTable1 = function() {
      var base_url = '{!! url('admin/patient-datatable-ajax') !!}';

      $('#patient_datatable').DataTable({
        "responsive": true,
        "searchDelay": 500,
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url" : base_url,
          "dataType" : 'json',

        },
        columns: [
        {"data": 'nid'},
        {"data": 'patient_id'},
        {"data": 'name'},
        {"data": 'phone'},
        {"data": 'email'},
        {"data": 'image'},
        {"data": 'gender'},
        {"data": 'blood_group'},
        {"data": 'dob'},
        {"data": 'actions'},
        ]

      });
    };
    return {
      init: function() {
        initTable1();
      },
    };
  }();
  jQuery(document).ready(function() {
    KTDatatablesDataSourceAjaxServer.init();
  });
</script>
<script type="text/javascript">
  // For image preview
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#uploaded_image')
        .attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#patient_form').submit(function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type:'POST',
        url: "{{ url('admin/patient')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (response) => {
          console.log(response)
          if(response.status_code == 422){
            var err_msg = '';
            $.each(response.errors,(i,error) => {
              err_msg += error + '\n';
            });
            swal({
              title: response.message,
              text: err_msg,
              closeOnClickOutside: false,
              button: 'OK'
            }).then(() => {
            });
          }else if(response.status_code == 200){
            $('#patient').modal('hide');
            swal({
              title: response.message,
              button: 'OK'
            }).then(() => {
              // window.location.href = '{{ url('admin/patient') }}';
              $('#patient_datatable').DataTable().ajax.reload();
              $('#patient_form')[0].reset();
            });
          }else{
            swal({
              title: 'You are not authorized!',
              button: 'OK'
            }).then(() => {
              window.location.href = document.referrer;
            });
          }
        },
        error: function(data){
         console.log(data);
       }
     });
    })
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#patient_datatable').on('click','#show',function(){
      var patient_id = $(this).attr('data-id');
      $.ajax({
        type:'GET',
        url: 'patient/'+patient_id,
        data: {},
        cache:false,
        contentType: false,
        processData: false,
        success: (response) => {
          // console.log(response['data'])
          var marital_status = {
            M  : 'Married',
            S  : 'Single',
            W  : 'Widowed',
            SP : 'Separated',
            NS : 'Not Specified'
          };

          $('#patient_name').html('');
          $('.gender').html('');
          $('.blood_group').html('');
          $('.marital_status').html('');
          $('.phone').html('');
          $('.email').html('');
          $('.address').html('');
          $('.allergy').html('');
          $('.remarks').html('');
          $('.tpa_id').html('');
          $('.tpa_validity').html('');
          $('.nid').html('');

          $('#patient_name').html(response['data'].name+' ('+response['data'].patient_id+')');
          response['data'].gender == 'M' ? $('.gender').html('Male') : (response['data'].gender == 'F' ? $('.gender').html('Female') : $('.gender').html('Other'));
          $('.blood_group').html(response['data'].blood_group);
          $('.marital_status').html(marital_status[response['data'].marital_status]);
          $('.phone').html(response['data'].phone);
          $('.age').html(getAge(response['data'].dob));
          $('.email').html(response['data'].email);
          $('.address').html(response['data'].address);
          $('.allergy').html(response['data'].allergy);

          $('.show-allergy-detail').attr('data-original-title',response['data'].allergy);

          $('.remarks').html(response['data'].remarks);
          $('.tpa_id').html(response['data'].tpa_id);
          $('.tpa_validity').html(response['data'].tpa_validity);
          $('.nid').html(response['data'].nid);
          if(response['data'].image){
            $('#patient_image').attr('src','');
            var BasePath = 'assets/images/';
            var Path = BasePath.concat(response['data'].image);
            var urr = '{{ asset(':id') }}';
            urr = urr.replace(':id',Path);
            $('#patient_image').attr('src',urr);
          }else{
            $('#patient_image').attr('src','{{ asset('assets/images/avatar.png') }}');
          }
        },
        error: function(data){
         console.log(data);
       }
     });
    })
  })
</script>
<script type="text/javascript">
  function getAge(dateString, indicator='') {
    var today = new Date();
    var birth = new Date(dateString);
    var years = today.getFullYear() - birth.getFullYear();
    var months = today.getMonth() - birth.getMonth();
    var days = today.getDate() - birth.getDate();
    if(months < 0){
      years = years - 1;
      months = 12 + parseInt(months);
    }
    if(days < 0){
      months = months - 1;
      days = 30+ parseInt(days);
    }
    if(indicator === 'age'){
      var ageObj = {
        Y : years,
        M : months,
        D : days
      };
      return ageObj;
    }
    var age = years+' yrs '+months+' months '+days+' days';
    return age;   
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#dob').on('change',function(){
      var dateString = $('#dob').val();
      var ageObj = getAge(dateString, 'age');
      $('#year').val(ageObj['Y']);
      $('#month').val(ageObj['M']);
      $('#day').val(ageObj['D']);
    })
  })
</script>
@endsection