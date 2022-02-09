<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/">
                <i class="nav-icon icon-speedometer"></i> Dashboard
            </a>
        </li>

        <li class="nav-title">MANAJEMEN PRODUK</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="nav-icon icon-folder"></i> Kategori
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index') }}">
                <i class="nav-icon icon-handbag"></i> Produk
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('image.index') }}">
                <i class="nav-icon icon-picture"></i> Galeri 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('payments.index') }}">
                <i class="nav-icon icon-basket"></i> Order
            </a>
        </li>
        <li class="nav-item ">
        <a class="nav-link" href="{{ route('report.order') }}">
                <i class="nav-icon icon-doc"></i> Laporan Penjualan
            </a>
           
        </li>
        <li class="nav-item ">
        <a class="nav-link" href="{{ route('ongkos.index') }}">
                <i class="nav-icon icon-basket-loaded"></i> Cek Ongkos Kirim
            </a>
        </li>
        <li class="nav-item ">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="nav-icon icon-logout"></i>  Logout
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </ul>
</nav>