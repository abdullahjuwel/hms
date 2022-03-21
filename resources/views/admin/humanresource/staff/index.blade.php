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

<section class="content">
  <div class="col-xs-12 no-padding">
    <div class="box-header">
      <h3 class="box-title" style="color: grey;"><i class="fa fa-sitemap"></i>&nbsp;&nbsp; Staff Directory</h3>
      <a href="{{ url('admin/hr/staff/create') }}"><button class="pull-right" type="button"><i class="glyphicon glyphicon-plus-sign"></i></button></a>
    </div>
    <div class="box-body table-responsive">
      <table id="patient_datatable" class="table table-bordered text-center" width="100%">
        <thead>
          <tr>
            <th>Role</th>
            <th>Search By Keyword</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="form-group">
                <div class="col-sm-12">
                  <select class="form-control select2" name="blood_group" id="blood_group" style="width: 100%;">
                    <option value="" disabled="" selected="">- - - Select - - -</option>
                    <option value="B+">B+</option>
                    <option value="A+">A+</option>
                    <option value="AB-">AB-</option>
                    <option value="AB+">AB+</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="A-">A-</option>
                    <option value="A+">A+</option>
                  </select>
                </div>
              </div>
            </td>
            <td>
              <div class="form-group">
                <div class="col-sm-12">
                  <input type="text" class="form-control" value="" name="nid" id="nid" placeholder="Search by staff id, name, mobile etc.">
                </div>
              </div>
            </td>
            <td>
              <a class='btn-primary btn btn-rounded' id='search' style='padding:0px 4px;' href='#'><i class='fa fa-search'></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div><br>
  </div>

  <div class="row" id="staffs">

    <!-- <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <img id="uploaded_image" src="{{ asset('public/assets/images/avatar.png') }}" class=" img-responsive img-lg" alt="Staff Image">
        <div class="info-box-content">
          <span class="info-box-text text-bold">Abdullah Juwel</span>
          <span class="progress-description">Staff ID : 9001</span>
          <span class="progress-description">Mobile : +8801700704436</span>
          <span class="progress-description"><span class='label label-danger'>Doctor</span></span><br>
          <a class='btn-info btn btn-rounded' id='search' style='padding:0px 4px;' href='#'><i class='fa fa-eye'></i></a>
          <a class='btn-primary btn btn-rounded' id='search' style='padding:0px 4px;' href='#'><i class='fa fa-edit'></i></a>
        </div>
      </div>
    </div> -->


  </div>
</section>
@endsection

@section('extra_script')

<script type="text/javascript">
  $(document).ready(function(){
    var url = '{{ url('admin/staff-data-ajax') }}';
      $.ajax({
        type:'GET',
        url: url,
        cache:false,
        contentType: false,
        processData: false,
        success: (response) => {
          // console.log(response);
          var full_string = '';
          if(response.data && response.status == 'success' && response.status_code == 200){
            $.each(response.data, function(index,value){
            var BasePath = 'assets/images/';
            var Path     = BasePath.concat(value.image);
            var urr      = '{{ asset(':id') }}';
            urr          = urr.replace(':id',Path);

            var view_url = 'staff/profile/'+value['staff_id'];

            full_string   += "<div class='col-md-3 col-sm-6 col-xs-12'>"
            full_string   += "<div class='info-box'>"
            full_string   += "<img id='uploaded_image' src='"+urr+"' class='img-responsive img-lg' alt='Staff Image' style='height:110px'>"
            full_string   += "<div class='info-box-content'>"
            full_string   += "<span class='info-box-text text-bold'>"+value['name']+"</span>"
            full_string   += "<span class='progress-description'>Staff ID : "+value['staff_id']+"</span>"
            full_string   += "<span class='progress-description'>Mobile : +88"+value['phone']+"</span>"
            full_string   += "<span class='progress-description'><span class='label label-danger'>"+value['role']['name']+"</span></span><br>"
            full_string   += "<a class='btn-info btn btn-rounded' id='search' style='padding:0px 4px;' href='"+view_url+"'><i class='fa fa-eye'></i></a>&nbsp;"
            full_string   += "<a class='btn-primary btn btn-rounded' id='search' style='padding:0px 4px;' href='#'><i class='fa fa-edit'></i></a>"
            full_string   += "</div>"
            full_string   += "</div>"
            full_string   += "</div>"
            });
            $('#staffs').html(full_string);
          }else{

          }
        },
        error: function(data){
         console.log(data);
       }
     });
  })
</script>

@endsection