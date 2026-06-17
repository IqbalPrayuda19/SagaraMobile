<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sagara Mobile</title>
    <link rel="stylesheet" crossorigin href="/css/app.css">
    <link rel="stylesheet" crossorigin href="/css/app-dark.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @media (max-width: 768px) {
            #sidebar {
                width: 75%;
                height: 100%;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1030;
                background-color: white;
                box-shadow: 0 0 10px rgba(0,0,0,0.2);
            }
        }

        @media (max-width: 992px) {
            #sidebar {
                width: 75%;
                height: 100%;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1030;
                background-color: white;
                box-shadow: 0 0 10px rgba(0,0,0,0.2);
            }
        }

        #main-content {
            flex: 1;
            min-width: 0;
            width: 100%;
        }

        @media (min-width: 992px) {
            #main-content {
                margin-left: 300px;
                width: calc(100% - 300px);
            }
        }

        .alert-success {
            background-color: #28a745 !important;
            color: white !important;
            border: none !important;
            border-radius: 0 !important;
            font-weight: 500;
        }

        .alert-success .btn-close {
            filter: brightness(0) invert(1);
        }
    </style>
</head>

<body style="background-color: #435ebe;">
    <script src="SagaraMobile/resources/initTheme.js"></script>
     {{-- Overlay untuk mobile --}}
    <div id="overlay"></div>
        <div id="app" class="d-flex">
            {{-- Sidebar untuk desktop --}}
            @include('dashboard.section.sidebar.index')

            <div id="main-content">
                @include('dashboard.section.header.index')
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @yield('container')
            </div>
        </div>
        <script>
            feather.replace();

            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');

            // Toggle saat klik hamburger
            toggleBtn?.addEventListener('click', function (event) {
                event.stopPropagation(); // jangan trigger click dari body
                console.log("Tombol hamburger diklik");

                sidebar.classList.toggle('d-none');
                sidebar.classList.toggle('active');
            });

            // Tutup sidebar jika klik di luar
            document.addEventListener('click', function (event) {
                // Cek apakah klik bukan di sidebar dan bukan di tombol toggle
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    if (!sidebar.classList.contains('d-none')) {
                        sidebar.classList.add('d-none');
                        sidebar.classList.remove('active');
                    }
                }
            });

            // Auto-dismiss alerts after 3 seconds
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alertElement) {
                    var bsAlert = bootstrap.Alert.getOrCreateInstance(alertElement);
                    bsAlert.close();
                });
            }, 3000);
        </script>
    </body>
</html>
