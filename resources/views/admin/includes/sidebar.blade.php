<nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="background-color: rgb(67, 79, 94)">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        document.querySelector('.navbar-vertical').classList.add('navbar-vibrant');
    </script>
    <div class="d-flex align-items-center" style="height: 75px;">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" aria-label="Toggle Navigation" data-bs-original-title="Toggle Navigation"
                style="background-color: white;">
                <span class="navbar-toggle-icon">
                    <span class="toggle-line"></span>
                </span>
            </button>
        </div><a class="navbar-brand" href="{{ route('admin.index') }}">
            <div class="d-flex align-items-center py-3">
                <span class="font-sans-serif">अ. ले. व्य. प्र.</span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                {{-- <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="dashboard">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><svg
                                    class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="chart-pie" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                    </path>
                                </svg>
                                <a href="{{ route('admin.index') }}">
                                    <span class="nav-link-text ps-1">Dashboard</span>
                                </a>

                        </div>
                    </a>

                </li> --}}


                {{--

                <li class="nav-item">
                    <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard3" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><svg
                                    class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="chart-pie" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                    </path>
                                </svg><!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com --></span><span
                                class="nav-link-text ps-1">Dashboard</span></div>
                    </a>
                    <ul class="nav collapse" id="dashboard3">
                        <li class="nav-item"><a class="nav-link active" href="index.html">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Default</span>
                                </div>
                            </a><!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="dashboard/analytics.html">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Analytics</span>
                                </div>
                            </a><!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="dashboard/crm.html">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">CRM</span></div>
                            </a><!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="dashboard/e-commerce.html">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">E
                                        commerce</span></div>
                            </a><!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="dashboard/lms.html">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">LMS</span><span
                                        class="badge rounded-pill ms-2 badge-soft-success">New</span></div>
                            </a><!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="dashboard/project-management.html">
                                <div class="d-flex align-items-center"><span
                                        class="nav-link-text ps-1">Management</span></div>
                            </a><!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="dashboard/saas.html">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">SaaS</span>
                                </div>
                            </a><!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link" href="dashboard/support-desk.html">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Support
                                        desk</span><span class="badge rounded-pill ms-2 badge-soft-success">New</span>
                                </div>
                            </a><!-- more inner pages-->
                        </li>
                    </ul>
                </li> --}}


                <li class="nav-item">
                    <!-- label-->
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">डाटा
                        </div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>


                    <li class="nav-item">
                        <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard9" role="button"
                            data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                            <div class="d-flex align-items-center"><i class="fa-solid fa-border-all"></i><span
                                    class="nav-link-text ps-1">अनुचित लेनदेन (मिटरब्याज) सम्बन्धी भर्ने निवेदन फाराम
                                </span></div>
                        </a>
                        <ul class="nav collapse {{ (Request::segment(2) == 'count') ? 'show' : '' }}" id="dashboard9">
                            <li class="nav-item"><a class="nav-link active"
                                    href="{{ route('admin.loangiving-victim.index') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">अनुचित लेनदेन (मिटरब्याज) सम्बन्धी ऋण दिने व्यक्तिले भर्नुपर्ने फाराम: २</span>
                                    </div>
                                </a><!-- more inner pages-->
                            </li>
                            <li class="nav-item"><a class="nav-link active"
                                    href="{{ route('admin.loantaking-victim.index') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">अनुचित लेनदेन (मिटरब्याज) सम्बन्धी  पीडितले भर्ने निवेदन फाराम : १</span>
                                    </div>
                                </a><!-- more inner pages-->
                            </li>

                        </ul>
                    </li>
                </li>





                <li class="nav-item">
                    <!-- label-->
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">कुल डाटा
                        </div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>


                    <li class="nav-item">
                        <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard8" role="button"
                            data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                            <div class="d-flex align-items-center"><i class="fa-solid fa-border-all"></i><span
                                    class="nav-link-text ps-1">कुल डाटा
                                </span></div>
                        </a>
                        <ul class="nav collapse {{ (Request::segment(2) == 'count') ? 'show' : '' }}" id="dashboard8">
                            <li class="nav-item"><a class="nav-link active"
                                    href="{{ route('admin.count.index') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1"> सूचीकरण</span>
                                    </div>
                                </a><!-- more inner pages-->
                            </li>
                            <li class="nav-item"><a class="nav-link active"
                                    href="{{ route('admin.count.create') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1"> सिर्जना</span>
                                    </div>
                                </a><!-- more inner pages-->
                            </li>

                        </ul>
                    </li>
                </li>
                
                @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4 || Auth::user()->role == 3)
                <li class="nav-item">
                    <!-- label-->
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">दर्ता</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>


                        <li class="nav-item">
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard1" role="button"
                                data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                                <div class="d-flex align-items-center"><i class="fa-solid fa-pen-nib"></i><span
                                        class="nav-link-text ps-1">दर्ता</span></div>
                            </a>
                            <ul class="nav collapse {{ (Request::segment(2) == 'registration') ? 'show' : '' }}" id="dashboard1">
                                @can('hasPermission', 'view_registration')
                                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ route('admin.registrations.index') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1"> सूचीकरण</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                @endcan

                                @can('hasPermission', 'create_registration')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.registrations.create') }}">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-text ps-1"> सिर्जना गर्नुहोस्</span>
                                            </div>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    </li>
                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">छलफल</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>

                        <li class="nav-item">
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard2" role="button"
                                data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                                <div class="d-flex align-items-center"><i class="fa-solid fa-comments-dollar"></i><span
                                        class="nav-link-text ps-1">छलफल</span></div>
                            </a>
                            <ul class="nav collapse {{ (Request::segment(2) == 'discussion') ? 'show' : '' }}" id="dashboard2">
                                {{-- <ul class="nav collapse show" id="dashboard2"> --}}
                                @can('hasPermission', 'view_discussion')
                                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.discussion.index') }}"">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1"> सूचीकरण</span>
                                            </div>
                                        </a>
                                    </li>
                                @endcan
                                @can('hasPermission', 'create_discussion')
                                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.discussion.create') }}"">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1"> सिर्जना गर्नुहोस्</span>
                                            </div>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    </li>
                    <li class="nav-item">

                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">फर्छ्यौट</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                        <li class="nav-item">
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard3" role="button"
                                data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                                <div class="d-flex align-items-center"><i class="fa-sharp fa-solid fa-repeat"></i><span
                                        class="nav-link-text ps-1">फर्छ्यौट</span></div>
                            </a>
                            <ul class="nav collapse  {{ (Request::segment(2) == 'release') ? 'show' : '' }}" id="dashboard3">
                                {{-- <ul class="nav collapse show" id="dashboard3"> --}}
                                @can('hasPermission', 'view_release')
                                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.releases.index') }}"">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">
                                                सूचीकरण</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                @endcan

                                @can('hasPermission', 'create_release')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.releases.create') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1"> सिर्जना गर्नुहोस्</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                @endcan
                            </ul>
                        </li>

                    </li>
                @endif

                @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4 || Auth::user()->role == 3)
                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">सामान्य रिपोर्टहरू</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>


                        <li class="nav-item">
                            <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard4" role="button"
                                data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                                <div class="d-flex align-items-center">
                                    <i class="fa-regular fa-file"></i>
                                    <span
                                        class="nav-link-text ps-1">रिपोर्टहरू</span></div>
                            </a>
                            <ul class="nav collapse {{ (Request::segment(2) == 'reports') ? 'show' : '' }}" id="dashboard4">

                                {{-- @can('hasPermission', 'view_general_reports') --}}
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.reports.registrations-details') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">दर्ता उजुरी विवरण<br> Registration
                                                    R-1</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                {{-- @endcan --}}
                                    <hr>
                                {{-- @can('hasPermission', 'view_general_reports') --}}
                                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ route('admin.reports.releaseDetails') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">फर्छ्याेट उजुरि विवरण <br>
                                                Release Details R-2 </span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                {{-- @endcan --}}
                                <hr>
                                {{-- @can('hasPermission', 'view_general_reports') --}}
                                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ route('admin.reports.agreement_no_implementation_details') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">सहमतीभै कार्यान्वयन हुन बाँकीको विवरण <br>
                                                Agreement But No Implementation Details R-6</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                {{-- @endcan --}}
                                <hr>
                                {{-- @can('hasPermission', 'view_general_reports') --}}
                                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ route('admin.reports.no_agreement_on_discussion_details') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">छलफल गर्दा फर्छ्यौट/सहमती हुन नसकेको उजुरी
                                                विवरण <br>No Agreement on Discussion Details R-7 </span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                {{-- @endcan --}}
                                <hr>
                                {{-- @can('hasPermission', 'view_general_reports') --}}
                                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ route('admin.reports.under_discussion_details') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">छलफलको क्रममा रहेका उजुरी <br>Under
                                                    Discussion Details R-8</span>

                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                {{-- @endcan --}}

                            </ul>
                        </li>

                    </li>


                    @can('hasPermission', 'view_intrigated_reports')
                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">एकीकृत रिपोर्टहरू</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>

                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator" href="#dashboard5" role="button"
                                data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-book"></i><span class="nav-link-text ps-1">एकीकृत रिपोर्टहरू</span></div>
                            </a>
                            <ul class="nav collapse {{ (Request::segment(2) == 'reports') ? 'show' : '' }}" id="dashboard5">

                                @can('hasPermission', 'view_intrigated_reports')
                                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ route('admin.reports.integrated_no_transaction_details') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">लिनदिन नपर्ने फर्छ्यौट एकीकृत <br>Integrated No Transaction Details (R-3)</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                @endcan
                                <hr>
                                @can('hasPermission', 'view_intrigated_reports')
                                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ route('admin.reports.integrated_with_transaction_details') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1"> लिनदिन पर्ने एकीकृत <br>Transaction Needed All Details  R-4</span>

                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                @endcan
                                <hr>
                                @can('hasPermission', 'view_intrigated_reports')
                                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ route('admin.reports.collectives') }}">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">एकीकृत <br>All
                                                    Details(R-5)</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                @endcan

                            </ul>
                        </li>

                    </li>

                    @endcan
                @endif

                @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3 )

                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">डाटा अपलोड</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>

                        <li class="nav-item">
                            <a class="nav-link dropdown-indicator" href="#dashboard7" role="button"
                                data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><svg
                                            class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false"
                                            data-prefix="fas" data-icon="chart-pie" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                            </path>
                                        </svg></span><span class="nav-link-text ps-1">अपलोड</span></div>
                            </a>
                            <ul class="nav collapse {{ (Request::segment(2) == 'uploads') ? 'show' : '' }}" id="dashboard7">

                                <li class="nav-item"><a class="nav-link active"
                                        href="{{ route('admin.import_index') }}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text ps-1">अपलोड</span>
                                        </div>
                                    </a><!-- more inner pages-->
                                </li>

                            </ul>
                        </li>

                    </li>
                @endif

                @can('hasPermission', 'view_history')
                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">सेटिङ</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>


                    <li class="nav-item">
                        <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard6" role="button"
                            data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-tools"></i>
                                <span class="nav-link-text ps-1">सेटिङ</span>
                            </div>
                        </a>
                        <ul class="nav collapse" id="dashboard6">


                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.purpose.index') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">लेनदेनको
                                            प्रयोजन</span>
                                    </div>
                                </a><!-- more inner pages-->
                            </li>

                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.nature.index') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">लेनदेनको
                                            प्रकृती</span>
                                    </div>
                                </a><!-- more inner pages-->
                            </li>
                            <li class="nav-item"><a class="nav-link active" href="{{ route('admin.proof.index') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">लेनदेनको
                                            प्रमाण</span>
                                    </div>
                                </a><!-- more inner pages-->
                            </li>


                            <li class="nav-item"><a class="nav-link"
                                    href="{{ route('admin.notransactionpurpose.index') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text ps-1">लिन दिन नपर्ने
                                            गरी फर्छ्यौट </span></div>
                                </a><!-- more inner pages-->
                            </li>
                        </ul>
                    </li>
                    </li>
                @endcan
                @can('hasPermission', 'view_history')
                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">प्रयोगकर्ता नियन्त्रण</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>

                        @can('hasPermission', 'view_roles')
                            <a class="nav-link" href="{{ route('admin.roles.index') }}" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon">
                                        <i class="fas fa-user-tag"></i></span><span class="nav-link-text ps-1">भूमिकाहरू
                                        <br>Roles</span></div>
                            </a>
                        @endcan

                        @can('hasPermission', 'view_permissions')
                            <a class="nav-link" href="{{ route('admin.permissions.index') }}" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon">
                                        <i class="fas fa-drum-steelpan"></i>
                                        <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                        class="nav-link-text ps-1">अनुमतिहरू <br>Permissions</span></div>
                            </a>
                        @endcan

                        @can('hasPermission', 'view_users')
                            <a class="nav-link" href="{{ route('admin.users.index') }}" role="button">
                                <div class="d-flex align-items-center"><span class="nav-link-icon">
                                        <i class="fas fa-users"></i>
                                        <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                        class="nav-link-text ps-1">प्रयोगकर्ताहरू<br>Users</span></div>
                            </a>
                        @endcan

                    </li>
                @endcan

                @can('hasPermission', 'view_history')
                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">इतिहास अभिलेख</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>

                        <a class="nav-link" href="{{ route('admin.application-history') }}" role="button">
                            <div class="d-flex align-items-center"><span class="nav-link-icon">
                                    <i class="fas fa-history"></i>
                                    <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                    class="nav-link-text ps-1">आवेदन इतिहास <br> Application History</span></div>
                        </a>

                        <a class="nav-link" href="{{ route('admin.system-history') }}" role="button">
                            <div class="d-flex align-items-center"><span class="nav-link-icon">
                                    <i class="fas fa-sort-alpha-up"></i>
                                    <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                    class="nav-link-text ps-1">प्रणाली इतिहास <br> System History</span></div>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</nav>
