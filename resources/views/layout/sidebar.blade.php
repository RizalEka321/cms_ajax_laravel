<div class="sidebar">
    <div class="logo_details">
        <i class='bx bx-code-alt'></i>
        <div class="logo_name">
            BSM-TRANS
        </div>
    </div>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}" class="nav-link {{ set_active('dashboard') }}">
                <i class="fa-solid fa-gauge"></i>
                <span class="links_name">
                    Dashboard
                </span>
            </a>
        </li>
        <li>
            <a href="{{ route('mobil') }}"
                class="nav-link {{ set_active(['mobil', 'mobil.add', 'mobil.edit', 'mobil_foto.show']) }}"
                id="kendaraan">
                <i class="fa-solid fa-car"></i>
                <span class="links_name">
                    Data Mobil
                </span>
            </a>
        </li>
        <li>
            <a href="{{ url('/expedisi/' . $slug='expedisi') }}" class="nav-link {{ set_active(['expedisi']) }}"
                id="expedisi">
                <i class="fa-solid fa-truck"></i>
                <span class="links_name">
                    Expedisi
                </span>
            </a>
        </li>
        <li>
            <a href="{{ route('kontak', $id = 1) }}" class="nav-link {{ set_active('kontak') }}" id="kontak">
                <i class="fa-solid fa-address-book"></i>
                <span class="links_name">
                    Kontak
                </span>
            </a>
        </li>
        <li>
            <a href="{{ route('user') }}" class="nav-link {{ set_active(['user', 'user.add', 'user.edit']) }}"
                id="user">
                <i class="fa-solid fa-users"></i>
                <span class="links_name">
                    Manajemen User
                </span>
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('log') }}" class="nav-link {{ set_active(['log']) }}" id="log">
                <i class="fa-solid fa-users-gear"></i>
                <span class="links_name">
                    Log Acivity
                </span>
            </a>
        </li> --}}
        <li class="login">
            <a href="{{ route('logout') }}">
                <span class="links_name login_out">
                    Logout
                </span>
                <i class="fa-solid fa-right-from-bracket" id="log_out"></i>
            </a>
        </li>
    </ul>
</div>
