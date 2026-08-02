<div>
    <nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
        <a href="../dashboard/index.html" class="b-brand text-primary">
            <span>Aplikasi Manajemen Pegawai</span>
        </a>
        </div>
        <div class="navbar-content">
        <ul class="pc-navbar">

            <x-sidebar.links title='Home' icon='ti ti-home' route='home' />
            @if (auth()->user()->role->role_name == 'supervisor')
                <x-sidebar.links title='Data Users' icon='ti ti-user' route='users.index' />
            @endif
            <x-sidebar.links title='Data Pegawai' icon='ti ti-users' route='pegawai.index' />
            <x-sidebar.links title='Data Bagian' icon='ti ti-briefcase' route='bagian.index' />

        </ul>
        </div>
    </div>
    </nav>
</div>