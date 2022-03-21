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
  background-color:#105e7d;
}
</style>

<form class="form-horizontal form_submit" method="POST" autocomplete="off">
  {{ csrf_field() }}
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box-header" style="background-color:#105e7d;">
          <h3 class="box-title" style="color: white;"><i class="fa fa-lock custom"></i>&nbsp;&nbsp;Permission Menu Management</h3>
          <a><button id="icon_change" class="pull-right" type="submit"><i class="fa fa-check-circle"></i></button></a>
        </div>
        <div class="box-body" style="padding: 1px;">

          <div class="col-md-6 no-padding">
            <div class="box-header" style="background-color:#56c8f5;">
              <h3 class="box-title"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Basic Information</h3>
            </div>
            <div class="box-body" style="padding: 4px;">

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Parent Menu</label>
                <div class="col-sm-9">
                 <select class="form-control select2" name="parent_id" id="parent_id" style="width: 100%;">
                  <option value="" disabled="" selected="">- - - Select - - -</option>
                  @if(!empty($menus))
                  @foreach($menus as $menuid => $menutitle)
                  <option value="{{ $menuid }}">{{ $menutitle }}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Title</label>
              <div class="col-sm-9">
               <input type="text" class="form-control" name="title" id="title" placeholder="Enter menu title">
             </div>
           </div>

           <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Alternate Title</label>
            <div class="col-sm-9">
             <input type="text" class="form-control" name="alt_title" id="alt_title" placeholder="Enter alternate title">
           </div>
         </div>

         <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Icon</label>
          <div class="col-sm-9">
            <div class="input-group">
              <input type="text" class="form-control" value="glyphicon glyphicon-th" readonly="" name="icon" id="icon">
              <span class="input-group-btn">
                <button type="button" class="btn btn-primary btn-flat" id="pick-icon" data-toggle="modal" data-target="#icons"><i class="glyphicon glyphicon-th"></i></button>
              </span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Menu Order</label>
          <div class="col-sm-9">
           <input type="text" class="form-control" name="order" id="order" value="999" placeholder="Enter alternate title" required="">
         </div> 
       </div>

       <br>
     </div>
   </div>

   <div class="col-md-6 no-padding">
    <div class="box-header" style="background-color:#56c8f5;">
      <h3 class="box-title"><i class="fa fa-road"></i>&nbsp;&nbsp;Route Information</h3>
    </div>

    <div class="box-body" style="padding: 4px;">

      <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">URI</label>
        <div class="col-sm-9">
         <select class="form-control select2" name="uri" id="uri" style="width: 100%;">
          <option selected="" disabled="" value="">- - - Select - - -</option>
          @if(!empty($all_routes))
          @foreach($all_routes as $key => $value)
          <option value="{{ $key }}">{{ $value }}</option>
          @endforeach
          @endif
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">URL</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="url" readonly="" id="url" placeholder="Enter menu url">
      </div>
    </div>

    <input type="hidden" name="id" id="id">

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Description</label>
      <div class="col-sm-9">
        <textarea class="form-control" rows="3" name="description" id="description" placeholder="Enter description (if any)"></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Is Active</label>
      <div class="col-sm-9">
        <input id="status" checked="" style="width: 20px;height: 20px;" name="status" value="1" type="checkbox">
      </div>
    </div>
    <br>
  </div>
</div>
</div>
</div>
</div>
<div class="col-xs-12 no-padding">
  <!-- <div class="box-header">
    <h3 class="box-title" style="color: white;"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp;All Permission Menu</h3>
  </div> -->
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered text-center" width="100%">
      <thead>
        <tr>
          <th>SL.</th>
          <th>Title</th>
          <th>Alternate Title</th>
          <th>URL</th>
          <th>Icon</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
</section>
</form>
@include('admin.role.menu.modal')
@endsection

@section('extra_script')
<script type="text/javascript">
  function refresh(){
   window.location.href = window.location.href.replace(/#.*$/, '');
 }
</script>
<script type="text/javascript">
  "use strict";
  var KTDatatablesDataSourceAjaxServer = function() {
    var initTable1 = function() {
      var base_url = '{!! url('admin/menu-datatable-ajax') !!}';

      $('#example1').DataTable({
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
        {"data": 'title'},
        {"data": 'alt_title'},
        {"data": 'url'},
        {"data": 'icon'},
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
  $('#uri').on('change',function () {
   $('#url').val($(this).val());
 });

  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
  });
  $(".form_submit").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    var url;
    var method;
    var id = $('#id').val();
    if(id){
      url = 'menu/'+id;
      method = 'PUT';
    }else{
      url = '{{ url('admin/permissions/menu') }}';
      method = 'POST';
    }

    $.ajax({
     url:url,
     method:method,
     data:data,
     success:function(response){
      $('#id').val('');
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
        swal({
          title: response.message,
          button: 'OK'
        }).then(() => {
          // window.location.href = '{{ url('admin/permissions/menu') }}';
          $('#example1').DataTable().ajax.reload();
          $('.form_submit')[0].reset();
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
  $('#icon-list').on('click','.col-md-4',function () {
    var icon = $(this).find('span').attr('class');
    $('#icon').val(icon);
    $('.modal').modal('toggle');
    $('#pick-icon').find('i').attr('class',icon);
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#example1').on('click','#edit',function(){
      var id = $(this).attr('data-id');
      $('#id').val(id);
      $.ajax({
        url: 'menu/'+id+'/edit',
        dataType : "json",
        success:function(data){
          $('#icon_change').find('i').removeClass('fa-check-circle');
          $('#icon_change').find('i').addClass('fa-edit');
          $('#uri').val(data.uri).trigger('change');
          $('#parent_id').val(data.parent_id).trigger('change');
          $('#title').val(data.title);
          $('#alt_title').val(data.alt_title);
          $('#icon').val(data.icon);
          $('#pick-icon').find('i').attr('class',data.icon);
          $('#order').val(data.order);
          $('#description').val(data.description);
          data.status == 1 ? $('#status').prop('checked', true) : $('#status').prop('checked', false)
        },
        error:function(error){
          console.log(error);
        }
      })
    })
  })
</script>


@endsection