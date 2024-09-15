    <div class="sidebar-wrapper active border-end h-full" style="height: 100%; min-height: 100vh;position: fixed; font-family:'Poppins', sans-serif; left:0;">
        <div class="sidebar-header border-bottom mx-1">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="/dashboard"><img src="/Assets/logo/Logo Dashboard.png" class="img-fluid" style="max-width: 100%; height: 50px; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));" alt="Logo" srcset=""></a>
                </div>
                {{-- <div class="theme-toggle d-flex gap-2  align-items-center">
                    <div class="px-2 pb-2"><i data-feather="sun"></i></div>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <div class=" pb-2"><i data-feather="moon"></i></div>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div> --}}
            </div>
        </div>

        <div class="sidebar-menu h-full" style="overflow-y: none;">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : ''}}">
                    <a href="/dashboard" class='sidebar-link'>
                        <i data-feather="home" style="color: #435ebe;"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('assets', 'create', 'edit',) ? 'active' : ''}}">
                    <a id="btn-dropdown" href="/assets" class='sidebar-link'>
                        <i data-feather="file" style="color: #435ebe;"></i>
                        <span>Assets</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('history') ? 'active' : ''}}">
                    <a id="btn-dropdown" href="/history" class='sidebar-link'>
                        <i data-feather="book-open" style="color: #435ebe;"></i>
                        <span>History</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('settings') ? 'active' : ''}}">
                    <a id="btn-dropdown" href="/settings" class='sidebar-link'>
                        <i data-feather="settings" style="color: #435ebe;"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button form="logout" href="{{route('logout')}}" onclick="event.preventDefault();
                                this.closest('form').submit();" class='sidebar-link cursor-pointer border-0 bg-white fw-bold'>
                            <i data-feather="log-out" style="color: #435ebe;"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <script>
        document.getElementById("btn-dropdown").addEventListener("click", function(){
        var dropdown = document.getElementById("dropdown")
        dropdown.classList.toggle("show")
        });
    </script>

