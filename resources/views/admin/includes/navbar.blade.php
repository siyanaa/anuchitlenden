<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand navbar-glass-shadow"
    style="background-color:rgb(67, 79, 94)">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false"
        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="index.html">
        <div class="d-flex align-items-center"><img class="me-2"
                src="{{ asset('adminassets/assets/img/icons/spot-illustrations/falcon.png') }}" alt=""
                width="40"><span class="font-sans-serif">अनुचित लेनदेन व्यवस्थापन प्रणाली</span></div>
    </a>
    <ul class="navbar-nav align-items-center d-none d-lg-block">
        <li class="nav-item">
        </li>



    </ul>
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">

        <!-- Button to open the modal -->
        <button id="openModalBtn" class="rounded btn-sm btn-primary">क्षेत्रफल परिवर्तन</button>

        <!-- The modal -->
        <div id="modalcalc" class="modalll">
            <div class="modal-contenttt">
                <span class="close" onclick="closeModalcalc()">&times;</span>
                <h5>क्षेत्रफल परिवर्तन</h5>
                <form id="converter">
                    <!-- Input fields for Ropani, Aana, Paisa, Daam -->
                    <label for="ropani">रोपनी:</label>
                    <input type="number" id="ropani" step="0.01" required oninput="convertLand()">

                    <label for="aana">आना:</label>
                    <input type="number" id="aana" step="0.01" required oninput="convertLand()">

                    <label for="paisa">पैसा:</label>
                    <input type="number" id="paisa" step="0.01" required oninput="convertLand()">

                    <label for="daam">दाम:</label>
                    <input type="number" id="daam" step="0.01" required oninput="convertLand()">

                </form>
                <div id="result" class="mt-2"></div>
            </div>
        </div>



        <li class="nav-item">

            <div class="theme-control-toggle fa-icon-wait px-2">
                <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox"
                    data-theme-control="theme" value="dark">
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Switch to light theme"
                    data-bs-original-title="Switch to light theme">
                    <svg class="svg-inline--fa fa-sun fa-w-16 fs-0" aria-hidden="true" focusable="false"
                        data-prefix="fas" data-icon="sun" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M256 160c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm246.4 80.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.4-94.8c-6.4-12.8-24.6-12.8-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4c-12.8 6.4-12.8 24.6 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.4-33.5 47.3 94.7c6.4 12.8 24.6 12.8 31 0l47.3-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3c13-6.5 13-24.7.2-31.1zm-155.9 106c-49.9 49.9-131.1 49.9-181 0-49.9-49.9-49.9-131.1 0-181 49.9-49.9 131.1-49.9 181 0 49.9 49.9 49.9 131.1 0 181z">
                        </path>
                    </svg><!-- <span class="fas fa-sun fs-0"></span> Font Awesome fontawesome.com --></label><label
                    class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Switch to dark theme"
                    data-bs-original-title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label>
            </div>
        </li>



        <li class="nav-item d-none d-sm-block">
            <a class="nav-link px-0" href="#" style="color: white;">
                {{ $user = Auth::user()->name }}
            </a>
        </li>


        <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="{{ asset('nepal-logo.png') }}" alt="">
                </div>
            </a>
            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                    {{-- <a class="dropdown-item fw-bold text-warning" href="#!"><svg class="svg-inline--fa fa-crown fa-w-20 me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="crown" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M528 448H112c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h416c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm64-320c-26.5 0-48 21.5-48 48 0 7.1 1.6 13.7 4.4 19.8L476 239.2c-15.4 9.2-35.3 4-44.2-11.6L350.3 85C361 76.2 368 63 368 48c0-26.5-21.5-48-48-48s-48 21.5-48 48c0 15 7 28.2 17.7 37l-81.5 142.6c-8.9 15.6-28.9 20.8-44.2 11.6l-72.3-43.4c2.7-6 4.4-12.7 4.4-19.8 0-26.5-21.5-48-48-48S0 149.5 0 176s21.5 48 48 48c2.6 0 5.2-.4 7.7-.8L128 416h384l72.3-192.8c2.5.4 5.1.8 7.7.8 26.5 0 48-21.5 48-48s-21.5-48-48-48z"></path></svg><!-- <span class="fas fa-crown me-1"></span> Font Awesome fontawesome.com --><span>Go Pro</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#!">Set status</a>
            <a class="dropdown-item" href="pages/user/profile.html">Profile &amp; account</a>
            <a class="dropdown-item" href="#!">Feedback</a>
            <div class="dropdown-divider"></div> --}}


                    {{-- <a class="dropdown-item" href="pages/user/settings.html">Settings</a> --}}
                    {{-- <a class="dropdown-item" href="{{ route('admin.users.edit-password') }}">Change Password</a> --}}
                    <a class="dropdown-item"
                        href="{{ route('admin.users.edit-password', ['id' => Auth::user()->id]) }}">पासवर्ड चेन्ज
                        गर्नुहोस</a>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        लग आउट
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </li>
    </ul>
</nav>
