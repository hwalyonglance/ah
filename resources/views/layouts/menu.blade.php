@php
    $user = Auth::user();
@endphp

@if($user->is_admin)
<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>
@endif

@if($user->is_admin)
<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <p>User</p>
    </a>
</li>
@endif

@if($user->is_admin)
<li class="nav-item">
    <a href="{{ route('materi.index') }}"
       class="nav-link {{ Request::is('materi*') ? 'active' : '' }}">
        <p>Materi</p>
    </a>
</li>
@endif
