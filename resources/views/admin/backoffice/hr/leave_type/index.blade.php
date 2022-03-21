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
          All Leave Type
        </h3>
      </div>
        <div class="box box-widget widget-user-2">
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
              <li class="active"><a href="{{ url('admin/leave-type') }}"><i class="fa fa-cubes"></i>&nbsp;&nbsp;Leave Type</a></li>
              <li><a href="{{ url('admin/department') }}"><i class="fa fa-building-o"></i>&nbsp;&nbsp;Department</a></li>
              <li><a href="{{ url('admin/designation') }}"><i class="fa fa-level-up"></i>&nbsp;&nbsp;Designation</a></li>
              <li><a href="{{ url('admin/specialist') }}"><i class="fa fa-medkit"></i>&nbsp;&nbsp;Specialist</a></li>
            </ul>
          </div>
        </div>
    </div>
    <div class="col-xs-10 no-padding">
      <div class="box-header">
        <h3 class="box-title" style="color: grey;"><i class="fa fa-cubes"></i>&nbsp;&nbsp; All Leave Types</h3>
        <a href="#"><button data-toggle="modal" data-target="#leave_type" data-backdrop="static" data-keyboard="false" class="pull-right" type="button"><i class="glyphicon glyphicon-plus-sign"></i></button></a>
      </div>
      <div class="box-body table-responsive">
        <table id="leave_type_datatable" class="table table-bordered text-center" width="100%">
          <thead>
            <tr>
              <th>SL</th>
              <th>Leave Type</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
  @include('admin.backoffice.hr.leave_type.modal')
@endsection

@section('extra_script')
<script type="text/javascript">
  "use strict";
  var KTDatatablesDataSourceAjaxServer = function() {
    var initTable1 = function() {
      var base_url = '{!! url('admin/leavetype-datatable-ajax') !!}';

      $('#leave_type_datatable').DataTable({
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
        {"data": 'leavetype_name'},
        {"data": 'status'},
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
  $("#leavetype_form").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url;
    var method;
    var id = $('#hidden_id').val();
    if(id){
      url = 'leave-type/'+id;
      method = 'PUT';
    }else{
      url = '{{ url('admin/leave-type') }}';
      method = 'POST';
    }

    $.ajax({
     url:url,
     method:method,
     data:data,
     success:function(response){
      $('#hidden_id').val('');
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
        $('#leave_type').modal('hide');
        swal({
          title: response.message,
          button: 'OK'
        }).then(() => {
          // window.location.href = '{{ url('admin/leave-type') }}';
          $('#leave_type_datatable').DataTable().ajax.reload();
          $('#leavetype_form')[0].reset();
        });
      }else if(response.status_code == 404){
        swal({
          title: response.message,
          button: 'OK'
        }).then(() => {
          $('#leave_type_datatable').DataTable().ajax.reload();
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

<!-- <script type="text/javascript">
  $(document).ready(function(){
    $('#leave_type_datatable').on('click','#edit',function(){
      var id = $(this).attr('data-id');
      $('#hidden_id').val(id);
      $.ajax({
        url: 'leave-type/'+id+'/edit',
        dataType : "json",
        success:function(data){
          // console.log(data)
          $('#icon_change').find('i').removeClass('fa-check-circle');
          $('#icon_change').find('i').addClass('fa-edit');
          $('#leavetype_name').val(data.leavetype_name);
          data.status == 1 ? $('#status').prop('checked', true) : $('#status').prop('checked', false)
        },
        error:function(error){
          console.log(error);
        }
      })
    })
  })
</script> -->

<script type="text/javascript">
    function get(id){
      $('#hidden_id').val(id);
    $.ajax({
        url: 'leave-type/'+id+'/edit',
        dataType : "json",
        success:function(data){
          // console.log(data)
          $('#leavetype_name').val(data.leavetype_name);
          data.status == 1 ? $('#status').prop('checked', true) : $('#status').prop('checked', false)
        },
        error:function(error){
          console.log(error);
        }
      })
  }
</script>

@endsection