        <!-- Sidebar -->
        <ul class="navbar-nav bg-pink sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/img/logo2.jpg') ?>" alt="Logo Elora's" style="width: 55px; height: 55px;">
            </div>
            <div class="sidebar-brand-text mx-3">ADMIN ELORA's</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Menu
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-box"></i> 
                <span>Kelola Produk</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Jenis Produk:</h6>
                    <a class="collapse-item" href="/produk/produk">
                        <i class="fas fa-cubes"></i>  
                        &nbsp;&nbsp;Produk
                    </a>
                    <a class="collapse-item" href="/produk/makeup">
                        <i class="fas fa-paint-brush"></i>  
                        &nbsp;&nbsp;Makeup
                    </a>
                    <a class="collapse-item" href="/produk/skincare">
                        <i class="fas fa-spa"></i> 
                        &nbsp;&nbsp;Skincare
                    </a>
                    <a class="collapse-item" href="/produk/hairnbody">
                        <i class="fas fa-hand-sparkles"></i>  
                        &nbsp;&nbsp;Hair and Bodycare
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/pelanggan/kelola_pelanggan">
                <i class="fas fa-fw fa-users"></i>
                <span>Kelola Pelanggan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/pesanan/kelola_pesanan">
                <i class="fas fa-shopping-bag"></i>
                <span>Kelola Pesanan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/ekspedisi/kelola_ekspedisi">
                <i class="fas fa-fw fa-shipping-fast"></i>
                <span>Kelola Ekspedisi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/kategori/kategori">
                <i class="fas fa-fw fa-folder"></i>
                <span>Kelola Kategori</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-file-alt"></i> 
                <span>Laporan</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Jenis Laporan:</h6>
                    <a class="collapse-item" href="/laporan/produk">
                        <i class="fas fa-box"></i> 
                        &nbsp;&nbsp;&nbsp;Data Produk
                    </a>
                    <a class="collapse-item" href="/laporan/pelanggan">
                        <i class="fas fa-user"></i> 
                        &nbsp;&nbsp;&nbsp;Data Pelanggan
                    </a>
                    <a class="collapse-item" href="/laporan/pesanan">
                        <i class="fas fa-shopping-cart"></i> 
                        &nbsp;&nbsp;Pesanan
                    </a>
                    <a class="collapse-item" href="/laporan/ekspedisi">
                        <i class="fas fa-shipping-fast"></i> 
                        &nbsp;&nbsp;Data Ekspedisi
                    </a>
                    <a class="collapse-item" href="/laporan/pendapatan">
                    <i class="fas fa-chart-line"></i> 
                        &nbsp;&nbsp;Pendapatan
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/produk/arsip">
                <i class="fas fa-fw fa-archive"></i>
                <span>Arsip Produk</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        </ul>
        <!-- End of Sidebar -->