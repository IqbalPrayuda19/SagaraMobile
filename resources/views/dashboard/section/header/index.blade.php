<div class="d-flex justify-content-between align-items-center border-bottom bg-white px-3 py-3 w-100 fw-bold" style="font-family: 'Poppins', sans-serif;">
    <!-- Hamburger (mobile only) -->
    <button class="btn d-lg-none" id="sidebarToggle">
        <i data-feather="menu"></i>
    </button>

    <!-- Logo (tengah di mobile) -->
    <div class="mx-auto d-md-none">
        <img src="/Assets/logo/Logo Dashboard.png" alt="Logo" height="40">
    </div>

    <!-- User Info (desktop & mobile) -->
    <div class="d-flex align-items-center ms-auto px-2">
        <p class="ms-2 mb-0 d-none d-md-block">{{ auth()->user()->name }}</p>
        <i data-feather="user" class="ms-2"></i>
    </div>
</div>
