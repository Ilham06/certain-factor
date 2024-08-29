<div class="page-header">
    <nav class="navbar navbar-expand-lg d-flex justify-content-between">
        <div class="container">
            <div class="fw-bold text-primary">Certain Factor</div>

            <div class="" id="navbarNav">
                <ul class="navbar-nav" id="leftNav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == '/' ? 'active' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'attribute' ? 'active' : '' }}"
                            href="{{ route('penyakit.index') }}">Data Penyakit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'dataset' ? 'active' : '' }}"
                            href="{{ route('gejala.index') }}">Data Gejala</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'result' ? 'active' : '' }}" href="">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'result' ? 'active' : '' }}"
                            href="">Perhitungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'result' ? 'active' : '' }}"
                            href="">Pengaturan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'user' ? 'active' : '' }}" href="">Pengguna</a>
                    </li>
                </ul>
            </div>
            <div class="" id="headerNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><img class="rounded-circle"
                                src="{{ asset('assets/images/avatar.webp') }}" alt="" /></a>
                        <div class="dropdown-menu dropdown-menu-end profile-drop-menu"
                            aria-labelledby="profileDropDown">

                            <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                @csrf
                                <button class="dropdown-item text-danger fw-bold rounded-1"
                                    onclick="return confirm('Apakah anda ingin logout?')">Logout</button>

                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
