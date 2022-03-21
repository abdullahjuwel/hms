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
        <h3 class="box-title" style="color: grey;"><i class="fa fa-users"></i>&nbsp;&nbsp;User Group Permission @if(!empty(session('success')))<span class="text-center" style="color: red">{{ session('success') }}</span>@endif</h3>
        <a href="#"><button class="pull-right" type="button"><i class="glyphicon glyphicon-plus-sign"></i></button></a>
      </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered text-center" width="100%">
          <thead>
            <tr>
              <th>SL.</th>
              <th>Group Name</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty($users))
            <?php $sl = 1; ?>
            @foreach($users as $user)
            <tr>
              <td>{{ $sl++ }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->created_at }}</td>
              <td>{{ $user->updated_at }}</td>
              <td>
                <a href="{{ url('admin/permissions/build/'.$user->id) }}" class='btn-primary btn btn-rounded' style='padding:0px 4px;' href='#'><i class='glyphicon glyphicon-lock'></i></a>
                <a class='btn-success btn btn-rounded' style='padding:0px 4px;' href='#'><i class='fa fa-edit'></i></a>
              </td>
            </tr>
            @endforeach
            @endif
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
    $('#example1').DataTable( {
    } );
  } );
</script>
@endsection