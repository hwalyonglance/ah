<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('materis.index') }}"
       class="nav-link {{ Request::is('materis*') ? 'active' : '' }}">
        <p>Materis</p>
    </a>
</li>


