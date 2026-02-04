<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">

                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left">
                                <i class="ti-home"></i>
                                <span class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>

                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li><a href="index.html">Dashboard 01</a></li>
                            <li><a href="index-02.html">Dashboard 02</a></li>
                            <li><a href="index-03.html">Dashboard 03</a></li>
                            <li><a href="index-04.html">Dashboard 04</a></li>
                            <li><a href="index-05.html">Dashboard 05</a></li>
                        </ul>
                    </li>

                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components</li>

                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left">
                                <i class="ti-palette"></i>
                                <span class="right-nav-text">{{ trans('main_trans.Grades') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>

                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('Grade.index') }}">{{ trans('main_trans.Grades_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left">
                                <i class="ti-calendar"></i>
                                <span class="right-nav-text">List Classes</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>

                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('Classroom.index') }}">{{ trans('main_trans.List_classes') }}</a></li>
                        </ul>
                    </li>

                    <!-- menu item todo-->
                    <li>
                        <a href="{{ url('sections') }}">
                            <i class="ti-menu-alt"></i>
                            <span class="right-nav-text">Sections</span>
                        </a>
                    </li>

                    <!-- menu item chat-->
                    <li>
                        <a href="{{ url('add-parent') }}">
                            <i class="ti-comments"></i>
                            <span class="right-nav-text">Parents</span>
                        </a>
                    </li>

                    <!-- menu item mailbox-->
                    <li>
                        <a href="{{ url('teachers') }}">
                            <span class="right-nav-text">Teachers</span>
                        </a>
                    </li>

                    <!-- menu item Charts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left">
                                <i class="ti-pie-chart"></i>
                                <span class="right-nav-text">Charts</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>

                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li><a href="chart-js.html">Chart.js</a></li>
                            <li><a href="chart-morris.html">Chart morris</a></li>
                            <li><a href="chart-sparkline.html">Chart Sparkline</a></li>
                        </ul>
                    </li>

                    <!-- Start Students Section -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                            <div class="pull-left">
                                <i class="ti-home"></i>
                                <span class="right-nav-text">Students</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>

                        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('students.index') }}">List students</a></li>
                            <li><a href="{{ route('students.create') }}">Add Students</a></li>
                            <li><a href="{{ route('promotions.index') }}">Promotions Students</a></li>
                            <li><a href="{{ route('promotions.create') }}">Students Managment</a></li>
                        </ul>
                    </li>
                    <!-- End Students Section -->

                </ul>
            </div>
        </div>
    </div> <!-- إغلاق row -->
</div> <!-- إغلاق container-fluid -->
