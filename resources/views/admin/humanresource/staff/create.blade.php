@extends('layouts.admin')
@section('content')
<link href="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
rel="stylesheet" type="text/css" />
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
    background-color:#105e7d;
  }
</style>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box-body" style="padding: 1px;">
        <div class="col-md-12 no-padding">
          <form class="form-horizontal" id="staff_form" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.humanresource.staff.form')
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('extra_script')
<script>
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
    $('#staff_form').submit(function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $('#iconChange').find('i').attr('class','fa fa-spinner fa-spin');
      $.ajax({
        type:'POST',
        url: "{{ url('admin/hr/staff')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (response) => {
          console.log(response)
          $('#iconChange').find('i').attr('class','fa fa-check-circle');
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
            swal({
              title: response.message,
              button: 'OK'
            }).then(() => {
              window.location.href = '{{ url('admin/hr/staff') }}';
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
@endsection