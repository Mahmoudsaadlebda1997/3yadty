<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/img/AdminLTELogo.png')}}"

             alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">عيادتي - لوحه التحكم</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/img/user8-128x128.jpg')}}"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Users -->
                @auth
                    @if(auth()->user()->user_type == 'ADMIN')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                المستخدمين
                            </a>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.create') }}">
                                إضافة مستخدم
                            </a>
                        </li>
                        </li>
                    @endif
                @endauth
            <!-- Specialties -->
                @auth
                    @if(auth()->user()->user_type == 'ADMIN')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('specialties.index') }}">
                                التخصصات الطبيه
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('specialties.create') }}">
                                إضافة تخصص
                            </a>
                        </li>
                    @endif
                @endauth
            <!-- Doctors -->
                @auth
                    @if(auth()->user()->user_type == 'ADMIN')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('doctors.index') }}">
                                الدكاتره
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('doctors.create') }}">
                                إضافة دكتور
                            </a>
                        </li>
                    @endif
                @endauth
            <!-- Patients -->
                @auth
                    @if(auth()->user()->user_type == 'ADMIN')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('patients.index') }}">
                                المرضي
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('patients.create') }}">
                                إضافة مريض
                            </a>
                        </li>
                    @endif
                @endauth
            <!-- Appointments -->
                @auth
                    @if(auth()->user()->user_type == 'DOCTOR' || auth()->user()->user_type == 'ADMIN')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('appointments.index') }}">
                                المواعيد
                            </a>
                        </li>
                    @endif
                @endauth
                @auth
                    @if(auth()->user()->user_type == 'ADMIN')
                    <!-- Sliders -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sliders.index') }}">
                                السلايدرز
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sliders.create') }}">
                                إضافة سلايدر
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
