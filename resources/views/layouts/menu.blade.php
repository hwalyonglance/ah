@php
    $user = Auth::user();
@endphp

@if($user->is_trainer)
<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>
@endif

@if($user->is_trainer)
<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <p>User</p>
    </a>
</li>
@endif

@if($user->is_trainer)
<li class="nav-item">
    <a href="{{ route('courseCategories.index') }}"
       class="nav-link {{ Request::is('courseCategories*') ? 'active' : '' }}">
        <p>Course Category</p>
    </a>
</li>
@endif

@if(!$user->is_trainer)
<li class="nav-item">
    <a href="{{ route('training.index') }}"
       class="nav-link {{ Request::is('training*') ? 'active' : '' }}">
        <p>Training</p>
    </a>
</li>
@endif

@if(!$user->is_trainer)
<li class="nav-item">
    <a href="{{ route('courses.index') }}"
       class="nav-link {{ Request::is('courses*') ? 'active' : '' }}">
        <p>Courses</p>
    </a>
</li>
@endif

@if(!$user->is_trainer)
<li class="nav-item">
    <a href="{{ route('exams.index') }}"
       class="nav-link {{ Request::is('exams*') ? 'active' : '' }}">
        <p>Exams</p>
    </a>
</li>
@endif
