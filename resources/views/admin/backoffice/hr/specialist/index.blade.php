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
    <div class="col-xs-2">
      <div class="box-header">
        <h3 class="box-title" style="color: grey;color: transparent;">
          Specialist List
        </h3>
      </div>
        <div class="box box-widget widget-user-2">
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
              <li><a href="{{ url('admin/leave-type') }}"><i class="fa fa-cubes"></i>&nbsp;&nbsp;Leave Type</a></li>
              <li><a href="{{ url('admin/department') }}"><i class="fa fa-building-o"></i>&nbsp;&nbsp;Department</a></li>
              <li><a href="{{ url('admin/designation') }}"><i class="fa fa-level-up"></i>&nbsp;&nbsp;Designation</a></li>
              <li class="active"><a href="{{ url('admin/specialist') }}"><i class="fa fa-medkit"></i>&nbsp;&nbsp;Specialist</a></li>
            </ul>
          </div>
        </div>
    </div>
    <div class="col-xs-10 no-padding">
      <div class="box-header">
        <h3 class="box-title" style="color: grey;"><i class="fa fa-medkit"></i>&nbsp;&nbsp; Specialist List</h3>
        <a href="#"><button data-toggle="modal" data-target="#spec_modal" data-backdrop="static" data-keyboard="false" class="pull-right" type="button"><i class="glyphicon glyphicon-plus-sign"></i></button></a>
      </div>
      <div class="box-body table-responsive">
        <table id="spec_datatable" class="table table-bordered text-center" width="100%">
          <thead>
            <tr>
              <th>SL</th>
              <th>Specialist Name</th>
              <th>Status</th>
              <th>Created Time</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
  @include('admin.backoffice.hr.specialist.modal')
@endsection

@section('extra_script')
<script type="text/javascript">
  "use strict";
  var KTDatatablesDataSourceAjaxServer = function() {
    var initTable1 = function() {
      var base_url = '{!! url('admin/spec-datatable-ajax') !!}';

      $('#spec_datatable').DataTable({
        "responsive": true,
        "searchDelay": 500,
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url" : base_url,
          "dataType" : 'json',
        },
        columns: [
        {"data": 'sl'},
        {"data": 'spec_name'},
        {"data": 'status'},
        {"data": 'created_at'},
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
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
  });
  $("#spec_form").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url;
    var method;
    var id = $('#hidden_spec_id').val();
    if(id){
      url = 'specialist/'+id;
      method = 'PUT';
    }else{
      url = '{{ url('admin/specialist') }}';
      method = 'POST';
    }

    $.ajax({
     url:url,
     method:method,
     data:data,
     success:function(response){
      $('#hidden_spec_id').val('');
      if(response.status_code == 422){
        var err_msg = '';
        $.each(response.errors,(i,error) => {
          err_msg += error + '\n';
        });
        swal({
          title: response.message,
          text: err_msg,
          button: 'OK'
        }).then(() => {
        });
      }else if(response.status_code == 200){
        $('#spec_modal').modal('hide');
        swal({
          title: response.message,
          button: 'OK'
        }).then(() => {
          // window.location.href = '{{ url('admin/leave-type') }}';
          $('#spec_datatable').DataTable().ajax.reload();
          $('#spec_form')[0].reset();
        });
      }else if(response.status_code == 404){
        swal({
          title: response.message,
          button: 'OK'
        }).then(() => {
          $('#spec_datatable').DataTable().ajax.reload();
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
    error:function(error){
      console.log(error);
    }
  });
  });
</script>
<script type="text/javascript">
    function get(id){
      $('#hidden_spec_id').val(id);
    $.ajax({
        url: 'specialist/'+id+'/edit',
        dataType : "json",
        success:function(data){
          // console.log(data)
          $('#spec_name').val(data.spec_name);
          data.status == 1 ? $('#status').prop('checked', true) : $('#status').prop('checked', false)
        },
        error:function(error){
          console.log(error);
        }
      })
  }
</script>

@endsection