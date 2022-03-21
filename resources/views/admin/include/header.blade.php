<div class="text-center" style="padding: 6px;background-color: #105e7d;color: white;"><b>Monowara Hospital & Diagnostic Centre</b>
  <a class="btn btn-sm btn-primary pull-right" href="" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>    
  <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
  </form>
</div>
<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse" >
        <ul class="nav navbar-nav">
          <?php
          $all_categories = \App\Model\Role\SysMenu::where('status',1)->orderBy('order')->get();
          $root_categories = DB::table('sys_menu')->where('status',1)->orderBy('order')->whereNull('parent_id')->get();

          $active_url = DB::table('sys_menu')->where('status',1)->where('url',request()->route()->uri)->first();
          if(empty($active_url))
          {
            $active_ids=[];
          }
          elseif(empty($active_url->parent_id))
          {
            $active_ids =[$active_url->id];
          }
          else{
             $childParentArray = buildChildParent($all_categories->toArray());
             $active_ids = getActiveNodes($childParentArray,$active_url->id);
          }

          $tree = formatTree($all_categories, $root_categories);
          print_tree_menu($active_ids,$tree);
          ?>
        </ul>
      </div>
      <?php  
      function print_tree_menu($active_ids,$menus,$self=false){
        foreach ($menus as $menu)
        {
          $is_active = in_array($menu->id,$active_ids)?'active':'';
          if(count($menu->children) <= 0)
          {
            ?>
            <li class="{{$is_active}}"><a href="@if(!is_null($menu->url)){{url($menu->url)}}@endif"><i class="{{$menu->icon}}"></i>&nbsp;&nbsp;{{$menu->title}}</a></li>
            <?php
          }
          else
          {
            ?>
            <li class="dropdown {{$is_active}}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{{$menu->icon}}"></i>&nbsp;&nbsp;{{$menu->title}} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <?php
                  print_tree_menu($active_ids,$menu->children,true)
                  ?>
                </li>
              </ul>
            </li>
            <?php
          }
        }
        if($self)
        {
          return 0;
        }
      }
      ?>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{ asset('public/assets/images/jewel.jpg') }}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>


