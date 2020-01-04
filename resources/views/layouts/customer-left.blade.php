<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a class="site_title"><img width="40px" src="{{url('/public/frontend/img/a.png')}}"> <span>Afqami Tech</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                  <img src="@if(Auth::user()->image=='') {{url('/public/customer/store-logo/cloth.png')}} @else {{url('/public/customer/store-logo/'.Auth::user()->image)}} @endif" alt="Store logo" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li>
                      <a href="{{url('/customer/dashboard')}}"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li>
                      <a href="{{url('/customer/manage-product')}}"><i class="fa fa-home"></i> Manage Product </a>
                  </li>
                  <li>
                      <a href="{{url('/customer/manage-category')}}"><i class="fa fa-home"></i> Manage Category </a>
                  </li>
                  <li>
                      <a href="{{url('/customer/billing')}}"><i class="fa fa-home"></i> Billing </a>
                  </li>
                    <li>
                      <a href="{{url('/customer/report')}}"><i class="fa fa-bar-chart"></i> Reports </a>
                  </li>
                  
                </ul>
              </div>

            </div>
      
          </div>
        </div>