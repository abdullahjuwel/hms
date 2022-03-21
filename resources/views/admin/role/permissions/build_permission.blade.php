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

<form class="form-horizontal" action="{{ url('admin/permissions/set/'.$id) }}" method="POST" autocomplete="off">
  {{ csrf_field() }}
  <section class="content">
    <div class="col-xs-12 no-padding">
      <div class="box-header">
        <h3 class="box-title" style="color: grey;"><i class="fa fa-users"></i>&nbsp;&nbsp;Build Permission</h3>
        <a href="{{ url('admin/permissions') }}"><button class="pull-right" type="button"><i class="glyphicon glyphicon-circle-arrow-left"></i></button></a>
        <a href="#"><button class="pull-right" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i></button></a>
      </div>
      <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered text-center">
          <thead>
           <tr style="background-color: #ffedf0;">
            <th class="no-sort">
              <input id="check-all" style="width: 15px;height: 15px;" class="ignore" type="checkbox">
            </th>
            <th>Name</th>
            <th>Uri</th>
            <th>Head</th>
            <th>Middleware</th>
          </tr>
        </thead>
        <tbody>
          @foreach($routes as $k=>$route)
          <?php
          $c = collect($user_group_permissions);
          $checked = $c->search(function ($item,$key) use($route){
            return (isset($route->action['as'])&&$route->action['as']==$item['as'])||
            ($route->uri==$item['uri']&&implode(',',$route->methods)==$item['http_verbs']);
          });
          ?>
          <tr>
            <td>
             
              <input {{$checked!==false?'checked':''}} class="route ignore" id="{{$k}}" type="checkbox" style="width: 15px;height: 15px;" name="routes[{{$k}}][checked]" value="1">
              
              <input type="hidden" name="routes[{{$k}}][as]" value="{{isset($route->action['as'])?$route->action['as']:''}}"/>
              <input type="hidden" name="routes[{{$k}}][uri]" value="{{$route->uri}}"/>
              <input type="hidden" name="routes[{{$k}}][http_verbs]" value="{{implode(',',$route->methods)}}"/>
            </td>
            <td class="text-center"><?= isset($route->action['as'])?$route->action['as']:'<i class="fa fa-close"></i>'?></td>
            <td>{{$route->uri}}</td>
            <td>{{isset($route->methods)?implode(',',$route->methods):''}}</td>
            <td>
              @if(isset($route->action['middleware']))
              {{is_array($route->action['middleware'])?implode(',',$route->action['middleware']):$route->action['middleware']}}
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
</form>
@include('admin.role.menu.modal')
@endsection

@section('extra_script')
<script type="text/javascript">
  $(document).ready(function() {
    $('#example1').dataTable({
      paging:false,
      responsive : true,
      "order": [],
      "columnDefs": [{
        "targets"  : 'no-sort',
        "orderable": false
      }]
    });
  });

    // $(document).on('submit','form',function (e) {
    //   $('#datatable_filter').find('input').val('');
    //   $('#datatable_filter').find('input').trigger('keyup');
    // });

    $('#check-all').click(function(){
      $('.route').prop('checked',this.checked);
    });
  </script>
  @endsection