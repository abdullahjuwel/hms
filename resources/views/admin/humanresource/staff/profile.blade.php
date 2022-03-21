@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{ asset('assets/images/'.$staff_data['image']) }}" alt="User profile picture">

          <h3 class="profile-username text-center">{{ $staff_data['name'] }}</h3>

          <p class="text-muted text-center">{{ $staff_data['desig_id'] }}</p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Staff ID</b> <a class="pull-right">{{ $staff_data['staff_id'] }}</a>
            </li>
            <li class="list-group-item">
              <b>Role</b> <a class="pull-right">{{ $staff_data['sys_group_id'] }}</a>
            </li>
            <li class="list-group-item">
              <b>Designation</b> <a class="pull-right">{{ $staff_data['desig_id'] }}</a>
            </li>
            <li class="list-group-item">
              <b>Department</b> <a class="pull-right">{{ $staff_data['dept_id'] }}</a>
            </li>
            <li class="list-group-item">
              <b>Specialist</b> <a class="pull-right">13,287</a>
            </li>
            <li class="list-group-item">
              <b>EPF No</b> <a class="pull-right">{{ $staff_data['epf_no'] }}</a>
            </li>
            <li class="list-group-item">
              <b>Basic Salary</b> <a class="pull-right">{{ $staff_data['basic_salary'] }}</a>
            </li>
            <li class="list-group-item">
              <b>Contract Type</b> <a class="pull-right">{{ $staff_data['contract_type'] }}</a>
            </li>
            <li class="list-group-item">
              <b>Work Shift</b> <a class="pull-right">{{ $staff_data['work_shift'] }}</a>
            </li>
            <li class="list-group-item">
              <b>Work Location</b> <a class="pull-right">{{ $staff_data['work_location'] }}</a>
            </li>
            <li class="list-group-item">
              <b>Date Of Joining</b> <a class="pull-right">{{ $staff_data['date_of_joining'] }}</a>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
          <li><a href="#payroll" data-toggle="tab">Payroll</a></li>
          <li><a href="#leaves" data-toggle="tab">Leaves</a></li>
          <li><a href="#attendence" data-toggle="tab">Staff Attendence</a></li>
          <li><a href="#documents" data-toggle="tab">Documents</a></li>
          <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
        </ul>
        <div class="tab-content" style="padding: 8px;">
          <div class="active tab-pane" id="profile">
            @include('admin.humanresource.staff.tab.profile')
          <!-- /.tab-pane -->
          <div class="tab-pane" id="payroll">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <li class="time-label">
                <span class="bg-red">
                  10 Feb. 2014
                </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-envelope bg-blue"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                  <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                  <div class="timeline-body">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                    quora plaxo ideeli hulu weebly balihoo...
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-primary btn-xs">Read more</a>
                    <a class="btn btn-danger btn-xs">Delete</a>
                  </div>
                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-user bg-aqua"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                  <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                  </h3>
                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-comments bg-yellow"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                  <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                  <div class="timeline-body">
                    Take me to your leader!
                    Switzerland is small and neutral!
                    We are more like Germany, ambitious and misunderstood!
                  </div>
                  <div class="timeline-footer">
                    <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                  </div>
                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline time label -->
              <li class="time-label">
                <span class="bg-green">
                  3 Jan. 2014
                </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-camera bg-purple"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                  <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                  <div class="timeline-body">
                        <!-- <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin"> -->
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="leaves">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
    @endsection
    @section('extra_script')
    <script>
      $(document).ready(function(){
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
          $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
      });
    </script>
    @endsection