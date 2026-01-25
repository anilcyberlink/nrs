<aside id="sidebar_left" class="nano nano-primary affix">

    <!-- Start: Sidebar Left Content -->
    <div class="sidebar-left-content nano-content">

        <!-- Start: Sidebar Header -->
        <header class="sidebar-header">
            <!-- Sidebar Widget - Search (hidden) -->
            <div class="sidebar-widget search-widget hidden">
                <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-search"></i>
              </span>
                    <input type="text" id="sidebar-search" class="form-control" placeholder="Search...">
                </div>
            </div>
        </header>

        <!-- Start: Sidebar Left Menu -->
        <ul class="nav sidebar-menu">
            <li class="sidebar-label pt15"> Navigations</li>
            <li class="{{ (Request::segment(2) == 'dashboard')?'active':'' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <span class="glyphicon glyphicon-home"></span>
                    <span class="sidebar-title">Dashboard</span>
                </a>
            </li>

            @if(checkAuth(1))
                <li class="{{ (Request::segment(2) == 'banner')?'active':'' }}">
                    <a href="{{ url('admin/banner') }}">
                        <span class="fa fa-file-image-o text-info" aria-hidden="true"></span>
                        <span class="sidebar-title"> Manage Banner</span>
                    </a>
                </li>
            @endif
            @if(checkAuth(2))
                <li>
                    @if(Request::segment(2) == 'posttype' || Request::segment(2) == 'postcategory' || Request::segment(2) == 'services' || Request::segment(2) == 'about-us' || Request::segment(2) == 'blogs' || Request::segment(2) == 'our-partners' || Request::segment(2) == 'contact-us')
                    <a class="accordion-toggle menu-open">
                    @else
                     <a class="accordion-toggle">
                             @endif
                        <span class="fa fa-files-o text-info"></span>
                        <span class="sidebar-title"> Manage Posts </span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">

                            <li class="{{ (Request::segment(2) == 'posttype')?'active':'' }}">
                                <a href="{{ url('type/posttype') }}">
                                    <span class="fa fa-arrows"></span>
                                    Post Types
                                </a>
                            </li>
                            <!--<li class="{{ (Request::segment(2) == 'postcategory')?'active':'' }}">-->
                            <!--    <a href="{{ url('admin/postcategory') }}">-->
                            <!--        <span class="fa fa-arrows"></span>-->
                            <!--        Post Categories-->
                            <!--    </a>-->
                            <!--</li>-->

                    <!-- Post Type List -->
                       @if($posttype)
                            @foreach($posttype as $row)
                            <li class="{{ (Request::segment(2) == $row->uri)?'active':'' }}">
                                @if(has_posts($row->id))
                                <a href="{{ url('admin/'.$row->uri)}}">
                                    @else
                                    <a href="{{ url('type/posttype/'.$row->id.'/edit') }}">
                                        @endif
                                    <span class="fa fa fa-arrows-h"></span>
                                    {{$row->post_type}}
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            @endif
            @if(checkAuth(3))
                <li class="">
                     @if(Request::segment(2) == 'our-trades')
                    <a class="accordion-toggle menu-open">
                    @else
                     <a class="accordion-toggle">
                             @endif
                        <span class="fa fa-files-o text-info" aria-hidden="true"></span>
                        <span class="sidebar-title"> Manage Portfolio </span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">

                      <li>
                        <a href="{{ url('admin/portfoliocategory') }}">
                          <span class="fa fa fa-arrows-h"></span>
                          Portfolio Category
                        </a>
                      </li> 

                         <li class="{{ (Request::segment(2) == 'our-trades')?'active':'' }}">
                            <a href="{{ url('admin/our-trades') }}">
                                <span class="fa fa fa-arrows-h"></span>
                                Portfolio
                            </a>
                        </li>
                    </ul>
                </li>
            @endif


            @if(checkAuth(9))
                <li class="">
                    <a class="accordion-toggle">
                        <span class="glyphicon glyphicon-user text-info"></span>
                        <span class="sidebar-title"> Manage Users </span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="{{ route('user.index') }}">
                                <span class="fa fa fa-arrows-h"></span>
                                Users
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('role.index') }}">
                                <span class="fa fa fa-arrows-h"></span>
                                User Roles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('adminmenu.index') }}">
                                <span class="fa fa fa-arrows-h"></span>
                                Admin Menus
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(checkAuth(13))
                <li class="">
                   @if(Request::segment(1) == 'newsletter-create' || Request::segment(1) == 'subscriber-create'|| Request::segment(1) == 'send-newsletter'|| Request::segment(1) == 'subscriber-index'|| Request::segment(1) == 'subscriber-edit'|| Request::segment(1) == 'newsletter-index'|| Request::segment(1) == 'newsletter-edit')
                    <a class="accordion-toggle menu-open">
                    @else
                     <a class="accordion-toggle">
                             @endif 
                        <span class="glyphicon glyphicon-user text-info"></span>
                        <span class="sidebar-title"> Manage Newsletter </span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                       <li class="{{ (Request::segment(1) == 'newsletter-create'|| Request::segment(1) == 'newsletter-index'|| Request::segment(1) == 'newsletter-edit')?'active':'' }}">
                            <a href="{{ route('newsletter.index') }}">
                                <span class="fa fa fa-arrows-h"></span>
                                Newsletters
                            </a>
                        </li>
                        <li class="{{ (Request::segment(1) == 'subscriber-create'|| Request::segment(1) == 'subscriber-index'|| Request::segment(1) == 'subscriber-edit')?'active':'' }}">
                            <a href="{{ route('subscriber.index') }}">
                                <span class="fa fa fa-arrows-h"></span>
                               Subscribers
                            </a>
                        </li>
                         <li class="{{ (Request::segment(1) == 'send-newsletter')?'active':'' }}">
                            <a href="{{ route('send.newsletter') }}">
                                <span class="fa fa fa-arrows-h"></span>
                               Send Newsletter
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
              @if(checkAuth(15))  
            <li class="">
               @if(Request::segment(2) == 'event' || Request::segment(2) == 'event-category'||Request::segment(2) == 'runners')
                <a class="accordion-toggle menu-open">
                @else
                 <a class="accordion-toggle">
                         @endif 
                <span class="glyphicon glyphicon-user text-info"></span>
                <span class="sidebar-title"> Manage Runners </span>
                <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li class="{{ (Request::segment(2) == 'event')?'active':'' }}">
                  <a href="{{ route('event.index') }}">
                       <span class="fa fa fa-arrows-h"></span>
                      <span class="sidebar-title">Event</span>
                  </a>
                  </li>  
                  <li class="{{ (Request::segment(2) == 'event-category')?'active':'' }}">
                  <a href="{{ route('event-category.index') }}">
                       <span class="fa fa fa-arrows-h"></span>
                      <span class="sidebar-title">Event Category</span>
                  </a>
                  </li>  
                  <!-- @if(checkAuth(14))-->
                  <!--  <li class="{{ (Request::segment(2) == 'runners')?'active':'' }}">-->
                  <!--<a href="{{ route('members-list') }}">-->
                  <!--     <span class="fa fa fa-arrows-h"></span>-->
                  <!--    <span class="sidebar-title">Runner List </span>-->
                  <!--</a>-->
                  <!--</li>   -->
                  <!--  @endif-->
                </ul>
            </li>
            @endif           
            
             @if(checkAuth(15))  
            <li class="">
               @if(Request::segment(2) == 'futsal-event' ||Request::segment(2) == 'futsal-team')
                <a class="accordion-toggle menu-open">
                @else
                 <a class="accordion-toggle">
                         @endif 
                <span class="glyphicon glyphicon-cd text-info"></span>
                <span class="sidebar-title"> Corporate Futsal </span>
                <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li class="{{ (Request::segment(2) == 'futsal-event')?'active':'' }}">
                  <a href="{{ route('futsal-event.index') }}">
                       <span class="fa fa fa-arrows-h"></span>
                      <span class="sidebar-title">Event</span>
                  </a>
                  </li>  
             
                   @if(checkAuth(14))
                    <li class="{{ (Request::segment(2) == 'futsal-team')?'active':'' }}">
                  <a href="{{ route('futsal-team.index') }}">
                       <span class="fa fa fa-arrows-h"></span>
                      <span class="sidebar-title">Futsal Team </span>
                  </a>
                  </li>   
                    @endif
                </ul>
            </li>
            @endif  

            @if(checkAuth(12))
              <li class="{{ (Request::segment(2) == 'settings')?'active':'' }}">
                <a href="{{ route('settings.index') }}">
                    <span class="fa fa-cogs text-info"></span>
                    <span class="sidebar-title"> Settings </span>
                </a>
            </li>
            @endif


            <div class="sidebar-toggle-mini">
                <a href="avoid:javascript;">
                    <span class="fa fa-sign-out"></span>
                </a>
            </div>
    </div>

</aside>
