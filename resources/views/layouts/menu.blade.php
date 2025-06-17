<div class="card pc-user-card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <img src="{{ asset('image/user.png') }}" alt="user-image"
                    class="user-avtar wid-45 rounded-circle" />
            </div>
            <div class="flex-grow-1 ms-3 me-2">
                <h6 class="mb-0">
                    admin
                </h6>
                <small>admin@gmail.com</small>
            </div>
            <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
                <svg class="pc-icon">
                    <use xlink:href="#custom-sort-outline"></use>
                </svg>
            </a>
        </div>
        {{-- <div class="collapse pc-user-links" id="pc_sidebar_userlink">
            <div class="pt-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link text-dark">
                        <i class="ti ti-power"></i> Logout
                    </button>
                </form>
            </div>
        </div> --}}
    </div>
</div>
<ul class="pc-navbar">
    <!-- ======= DASHBOARD ======= -->
    <li class="pc-item pc-caption"><label>Dashboard</label></li>
    <li class="pc-item">
        <a href="{{ route('dashboard') }}" class="pc-link">
            <span class="pc-micon"><i class="fas fa-home"></i></span>
            <span class="pc-mtext">Dashboard</span>
        </a>
    </li>

    <!-- ======= MASTER DATA ======= -->
    <li class="pc-item pc-caption"><label>Master Data</label></li>
    <li class="pc-item">
        <a href="{{ route('master.categories.index') }}" class="pc-link">
            <span class="pc-micon"><i class="fas fa-tags"></i></span>
            <span class="pc-mtext">Kategori</span>
        </a>
    </li>
    <li class="pc-item">
        <a href="{{ route('master.units.index') }}" class="pc-link">
            <span class="pc-micon"><i class="fas fa-ruler"></i></span>
            <span class="pc-mtext">Satuan</span>
        </a>
    </li>

    <!-- ======= INVENTORY ======= -->
    <li class="pc-item pc-caption"><label>Inventory</label></li>
    <li class="pc-item">
        <a href="{{ route('products.index') }}" class="pc-link">
            <span class="pc-micon"><i class="fas fa-box"></i></span>
            <span class="pc-mtext">Produk</span>
        </a>
    </li>
    <li class="pc-item">
        <a href="{{ route('locations.index') }}" class="pc-link">
            <span class="pc-micon"><i class="fas fa-map-marker-alt"></i></span>
            <span class="pc-mtext">Lokasi</span>
        </a>
    </li>
    <li class="pc-item">
        <a href="{{ route('stocks.index') }}" class="pc-link">
            <span class="pc-micon"><i class="fas fa-warehouse"></i></span>
            <span class="pc-mtext">Stok</span>
        </a>
    </li>

    <!-- ======= TRANSAKSI ======= -->
    <li class="pc-item pc-caption"><label>Transaksi</label></li>
    <li class="pc-item">
        <a href="{{ route('transactions.index') }}" class="pc-link">
            <span class="pc-micon"><i class="fas fa-exchange-alt"></i></span>
            <span class="pc-mtext">Transaksi</span>
        </a>
    </li>
</ul>
