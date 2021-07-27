<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.profile')}}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Profil
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.post')}}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Post
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('admin.konselor')}}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Konselor
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Konseling
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('admin.conseling.wait')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Tunggu</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Konseling Aktif</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Konseling Selesai</p>
            </a>
        </li>
    </ul>
</li>