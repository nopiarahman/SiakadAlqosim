<div>
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="{{ url('/') }}" class="app-brand-link">
                <img src="{{ asset('img/logo pondok.png') }}" alt="" srcset="" height="120">
                {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2">SIAKAD</span> --}}
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboard -->

            <li class="menu-item @if (Request::path() == 'dashboard') active @endif">
                <a href="{{ url('/dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            @role('Super-Admin')
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Master Data</span>
                </li>
                <li class="menu-item  @yield('menuMarhalah')">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-school"></i>
                        <div data-i18n="marhalah">Marhalah/Jenjang</div>
                    </a>
                    <ul class="menu-sub ">
                        <li class="menu-item @yield('submenuMarhalah1')">
                            <a href="{{ url('/marhalah') }}" class="menu-link">
                                <div data-i18n="marhalah">List Semua Marhalah</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Components -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Admin</span></li>

                <!-- Extended components -->
                <li class="menu-item @yield('menuUser') ">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-copy"></i>
                        <div data-i18n="Extended UI">User</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item @yield('subMenuUser1')">
                            <a href="{{ url('/user/admin') }}" class="menu-link">
                                <div data-i18n="Perfect Scrollbar">Admin</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endrole
            @role('Super-Admin|admin')
                <!-- Forms & Tables -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Master Data</span></li>
                <!-- Forms -->
                <li class="menu-item @yield('menuSantri')">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Form Elements">Santri</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item @yield('subMenuSantri1')">
                            <a href="{{ url('/santri') }}" class="menu-link">
                                <div data-i18n="Input groups">Santri Aktif</div>
                            </a>
                        </li>
                        @role('admin')
                            <li class="menu-item @yield('subMenuSantri2')">
                                <a href="{{ url('/kelas-santri') }}" class="menu-link">
                                    <div data-i18n="Basic Inputs">Berdasarkan Kelas</div>
                                </a>
                            </li>
                        @endrole
                        @role('Super-Admin')
                            <li class="menu-item @yield('subMenuSantri2')">
                                <a href="{{ url('/kelas-santri-marhalah') }}" class="menu-link">
                                    <div data-i18n="Basic Inputs">Berdasarkan Marhalah</div>
                                </a>
                            </li>
                        @endrole
                        <li class="menu-item @yield('subMenuSantri1')">
                            <a href="{{ url('/santri') }}" class="menu-link">
                                <div data-i18n="Input groups">Alumni</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item @yield('menuGuru')">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-user-voice"></i>
                        <div data-i18n="Form Layouts">Guru</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item @yield('subMenuGuru1')">
                            <a href="{{ url('/guru') }}" class="menu-link">
                                <div data-i18n="Vertical Form">Semua Guru</div>
                            </a>
                        </li>
                        <li class="menu-item @yield('subMenuGuru2')">
                            <a href="{{ url('/halaqoh') }}" class="menu-link">
                                <div data-i18n="Horizontal Form">Pengampu Halaqoh</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item @yield('menuKelas')">
                    <a href="{{ url('/kelas') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar"></i>
                        <div data-i18n="Tables">Kelas</div>
                    </a>
                </li>
                @role('Super-Admin')
                    <li class="menu-item  @yield('menuMapel')">
                        <a href="{{ url('/mapel') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-food-menu"></i>
                            <div data-i18n="Tables">Mata Pelajaran</div>
                        </a>
                    </li>
                @endrole
            @endrole
            @role('admin|guru')
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Akademik</span></li>
                @role('guru')
                    <li class="menu-item @yield('menuJadwalGuru')">
                        <a href="{{ url('/jadwal-guru') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div data-i18n="Tables">Jadwal Guru</div>
                        </a>
                    </li>
                @endrole
                @role('admin')
                    <li class="menu-item @yield('menuJadwal')">
                        <a href="{{ url('/jadwal') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div data-i18n="Tables">Jadwal Pelajaran</div>
                        </a>
                    </li>
                    <li class="menu-item @yield('menuNilai')">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-select-multiple"></i>
                            <div data-i18n="Form Layouts">Nilai</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item @yield('subMenuGuru1')">
                                <a href="{{ url('/test') }}" class="menu-link">
                                    <div data-i18n="Vertical Form">test</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole
            @endrole
            @role('Super-Admin')
                <li class="menu-item @yield('menuPeriode')">
                    <a href="{{ '/periode' }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-time"></i>
                        <div data-i18n="Tables">Periode</div>
                    </a>
                </li>
            @endrole
            @role('waliKelas')
                <li class="menu-item @yield('menuRaportSantri')">
                    <a href="{{ '/raport-kelas' }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-time"></i>
                        <div data-i18n="Tables">Raport Santri</div>
                    </a>
                </li>
            @endrole
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Laporan</span></li>
            <li class="menu-item @yield('menuRaport')">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-task"></i>
                    <div data-i18n="Form Layouts">Raport Santri</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item @yield('subMenuGuru1')">
                        <a href="{{ url('/guru') }}" class="menu-link">
                            <div data-i18n="Vertical Form">Raport MID</div>
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item @yield('subMenuGuru1')">
                        <a href="{{ url('/guru') }}" class="menu-link">
                            <div data-i18n="Vertical Form">Raport Semester</div>
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item @yield('subMenuGuru1')">
                        <a href="{{ url('/guru') }}" class="menu-link">
                            <div data-i18n="Vertical Form">Raport Tahfidz</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">
                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                    class="menu-link">
                    <i class="menu-icon tf-icons bx bx-support"></i>
                    <div data-i18n="Support">Support</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Documentation">Documentation</div>
                </a>
            </li>
        </ul>
    </aside>
    <!-- / Menu -->
</div>
