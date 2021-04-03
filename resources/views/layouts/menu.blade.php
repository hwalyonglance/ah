<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('materi.index') }}"
       class="nav-link {{ Request::is('materi*') ? 'active' : '' }}">
        <p>Materi</p>
    </a>
</li>
