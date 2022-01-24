 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar">
         <!-- Sidebar user panel -->
         <div class="user-panel">
             <div class="pull-left image">
                 <img src="{{ asset('adminassets/dist/img/zz.png') }}" class="img-circle" alt="User Image" />
             </div>
             <div class="pull-left info">
                 <p>بلاك هورس</p>

                 <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
             </div>
         </div>
         <!-- search form -->
         {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="البحث..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form> --}}
         <!-- /.search form -->
         <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu">


             <li class="active treeview">
                 <a href="{{ url('/home') }}">
                     <i class="fa fa-dashboard"></i> <span>الرئيسية</span> <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 {{-- <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> --}}
             </li>
             <li class="header">بيانات أساسية </li>
             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-files-o"></i>
                     <span>الإعدادات</span>
                     <i class="fa fa-angle-left pull-right"></i>
                     {{-- <span class="label label-primary pull-right">4</span> --}}
                 </a>
                 <ul class="treeview-menu">
                    <li><a href="{{ route('company.index') }}"><i class="fa fa-circle-o"></i> الشركات </a></li>
                    <li><a href="{{ route('branch.index') }}"><i class="fa fa-circle-o"></i> الفروع </a></li>

                     <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> المستخدمين </a></li>
                     <li><a href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i> الأدوار </a></li>
                     <li><a href="{{ route('room.index') }}"><i class="fa fa-circle-o"></i> القاعات </a></li>
                     <li><a href="{{ route('course.index') }}"><i class="fa fa-circle-o"></i> الدورات </a></li>
                     <li><a href="{{ route('trainer.index') }}"><i class="fa fa-circle-o"></i> المدربين </a></li>
                     <li><a href="{{ route('round.index') }}"><i class="fa fa-circle-o"></i> المجموعات </a></li>
                     <li><a href="{{ route('deploma.index') }}"><i class="fa fa-circle-o"></i> الدبلومات </a></li>
                 </ul>
             </li>

             {{-- <li>
          <a href="widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
          </a>
        </li> --}}

             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-th"></i>
                     <span>مجموعات حالية</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu">

                     <li><a href="{{ route('current-groups.index') }}"><i class="fa fa-circle-o"></i> المجموعات الحالية </a></li>
            {{-- <li><a href="{{ route('color.index') }}"><i class="fa fa-circle-o"></i> الالوان </a></li>
            <li><a href="{{ route('articles.index') }}"><i class="fa fa-circle-o"></i> المقالات </a></li> --}}

                 </ul>
             </li>
             {{-- <li><a href="{{ route('city.index') }}"><i class="fa fa-circle-o"></i> الدليفرى </a></li> --}}

             <li class="treeview">
                 <a href="">
                     <i class="fa fa-users"></i>
                     <span>خدمة عملاء</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu">
                     <li>

                         {{-- <li>
                    <a href="{{ route('category.index') }}"><i class="fa fa-circle-o text-red"></i> <span>عرض التصنيفات</span></a>
                </li>
                  <li><a href="{{ route('category.create') }}"><i class="fa fa-circle-o"></i> اضافه تصنيف</a></li> --}}

                 </ul>
             </li>




             <li class="header">ماليات</li>

             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-edit"></i> <span>المالية</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu">
                     {{-- <li><a href="{{ route('admin-slider.index') }}"><i class="fa fa-circle-o"></i>  الصور الرئيسيه </a></li> --}}

                 </ul>
             </li>

             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-table"></i> <span>أرشيف الدورات</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu">
                 </ul>
             </li>

             {{-- <li>
          <a href="calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <small class="label pull-right bg-red">3</small>
          </a>
        </li>

        <li class="treeview">
          <a href="mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="mailbox.html">Inbox <span class="label label-primary pull-right">13</span></a></li>
            <li><a href="compose.html">Compose</a></li>
            <li><a href="read-mail.html">Read</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>

        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>

        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> --}}
         </ul>
     </section>
     <!-- /.sidebar -->
 </aside>
