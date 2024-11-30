<nav>
    <div class="logo-box sidebar-toggle">
        <div class="logo-image">
            <img src="{{ asset('Tienda.png')}}" alt="logo">
        </div>

        <span class="logo-name">Store</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li>
                <a href="/" title="Dashboard">
                    <i class='bx bx-medal'></i>
                    <span class="link-name">Tablero</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sales') }}" title="Ventas">
                    <i class='bx bx-money'></i>
                    <span class="link-name">Ventas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('offers') }}" title="Ofertas">
                    <i class='bx bxs-offer'></i>
                    <span class="link-name">Ofertas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('products') }}" title="Productos">
                    <i class='bx bx-baguette'></i>
                    <span class="link-name">Productos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('supplies') }}" title="Insumos">
                    <i class='bx bx-shopping-bag'></i>
                    <span class="link-name">Insumos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('paymentMethods') }}" title="Productos">
                    <i class='bx bx-credit-card' ></i>
                    <span class="link-name">Medios de pago</span>
                </a>
            </li>
        </ul>
        
        <ul class="logout-mode">
            <li class="mode">
                <a href="#">
                    <i class='bx bx-moon'></i>
                    <span class="link-name">Modo oscuro</span>
                </a>

            <div class="mode-toggle">
                <span class="switch"></span>
            </div>
        </li>
        </ul>
    </div>
</nav>