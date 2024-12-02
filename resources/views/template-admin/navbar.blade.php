<ul class="metismenu" id="menu">
    <li class="menu-label">MENU UTAMA</li>
    <li>
        <a href="/dashboard">
            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    @if (Auth::user()->role == 'admin')
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-data'></i></div>
            <div class="menu-title">Master Data</div>
        </a>
        <ul>
            <li>
                <a href="/no_rm"><i class='bx bx-file'></i>No RM</a>
            </li>
            <li>
                <a href="/ruangan"><i class='bx bx-building'></i>Ruangan</a>
            </li>
            <li>
                <a href="/user"><i class='bx bx-user'></i>User</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="/insiden">
            <div class="parent-icon"><i class='bx bx-error-circle'></i></div>
            <div class="menu-title">Insiden</div>
            </a>
        </li>
    @endif
</ul>
