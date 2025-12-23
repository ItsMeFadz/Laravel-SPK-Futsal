<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('Dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo/logo-SMA.jpeg') }}" width="28">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">SPK FUTSAL</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ $active === 'Dashboard' ? 'active' : '' }}">
            <a href="{{ route('Dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-alt"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Master</span>
        </li>
        <li class="menu-item {{ $active === 'Kriteria' ? 'active' : '' }}">
            <a href="{{ route('index.kriteria') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Kriteria</div>
            </a>
        </li>
        @if (auth()->user()->roleName() === 'admin')
            <li class="menu-item {{ $active === 'Posisi' ? 'active' : '' }}">
                <a href="{{ route('index.posisi') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-direction-right"></i>
                    <div data-i18n="Account Settings">Posisi</div>
                </a>
            </li>
        @endif
        <li class="menu-item {{ $active === 'Pemain' ? 'active' : '' }}">
            <a href="{{ route('index.pemain') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Account Settings">Pemain</div>
            </a>
        </li>
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Latihan &amp; Penilaian</span></li>
        <!-- Cards -->
        <!-- User interface -->
        <li class="menu-item {{ $active === 'Latihan' ? 'active' : '' }}">
            <a href="{{ route('index.latihan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-run"></i>
                <div data-i18n="User interface">Latihan</div>
            </a>
        </li>
        <li class="menu-item {{ $active === 'Penilaian' ? 'active' : '' }}">
            <a href="{{ route('index.penilaian') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-search"></i>
                <div data-i18n="Basic">Penilaian</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Analisis &amp; Laporan</span></li>
        <!-- Extended components -->
        @if (auth()->user()->roleName() === 'admin')
            <li class="menu-item {{ $active === 'Perhitungan' ? 'active' : '' }}">
                <a href="{{ route('index.perhitungan') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-bar-chart-square"></i>
                    <div data-i18n="Extended UI">Perhitungan WP-Topsis</div>
                </a>
            </li>
        @endif
        <li class="menu-item {{ $active === 'hasilPerhitungan' ? 'active' : '' }}">
            <a href="{{ route('index.hasilPerhitungan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-check"></i>
                <div data-i18n="Extended UI">Hasil Penilaian</div>
            </a>
        </li>

        @if (auth()->user()->roleName() === 'admin')
        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan</span></li>
        <!-- Forms -->
            <li class="menu-item {{ $active === 'Pengguna' ? 'active' : '' }}">
                <a href="{{ route('index.pengguna') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Form Elements">Pengguna</div>
                </a>
            </li>
        @endif
    </ul>
</aside>
