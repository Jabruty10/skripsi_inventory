<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <!-- Beranda -->
                <a class="nav-link" href="{{ route('index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Beranda
                </a>

                <!-- MASTER SECTION -->
                <div class="sb-sidenav-menu-heading" style="padding-top:10px; padding-bottom:4px; margin-bottom:0;">Master</div>


                <!-- Data Barang (Dropdown) -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDatabarang" aria-expanded="false" aria-controls="collapseDatabarang">
                    <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                    Data Barang
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseDatabarang" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('databarang.kategori.index') }}">
                            <i class="fas fa-tags me-2"></i> Kategori
                        </a>
                        <a class="nav-link" href="{{ route('databarang.barang.index') }}">
                            <i class="fas fa-box me-2"></i> Barang
                        </a>
                    </nav>
                </div>

                <!-- Data Supplier -->
                <a class="nav-link" href="{{ route('supplier.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div> Data Supplier
                </a>

                <!-- Data Pembeli -->
                <a class="nav-link" href="{{ route('pembeli.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div> Data Pembeli
                </a>

                <!-- TRANSAKSI SECTION -->
                <div class="sb-sidenav-menu-heading" style="padding-top:10px; padding-bottom:4px; margin-bottom:0;">Transaksi</div>

                <!-- Barang Masuk -->
                <a class="nav-link" href="{{ route('barangmasuk.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div> Barang Masuk
                </a>

                <!-- Barang Keluar -->
                <a class="nav-link" href="{{ route('barangkeluar.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div> Barang Keluar
                </a>

                <!-- LAPORAN SECTION -->
                <div class="sb-sidenav-menu-heading" style="padding-top:10px; padding-bottom:4px; margin-bottom:0;">Laporan</div>

                <!-- Laporan (Dropdown) -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLaporan" aria-expanded="false" aria-controls="collapseLaporan">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                    Laporan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLaporan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('laporan.barang.index') }}">
                            <i class="fas fa-cubes me-2"></i> Data Barang
                        </a>
                        <a class="nav-link" href="{{ route('laporan.barangmasuk.index') }}">
                            <i class="fas fa-box-open me-2"></i> Barang Masuk
                        </a>
                        <a class="nav-link" href="{{ route('laporan.barangkeluar.index') }}">
                            <i class="fas fa-dolly me-2"></i> Barang Keluar
                        </a>
                    </nav>
                </div>

            </div>
        </div>
    </nav>
</div>
