<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/standerd')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Standerd</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/subject')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Subject</span>
            </a>
        </li>
        @php
            $checkUserType = Auth::user()->user_type;
        @endphp
        @if ($checkUserType == 0)    
        <li class="nav-item">
            <a class="nav-link" href="{{url('/teacher')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Teacher</span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{url('/parent')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Parent</span>
            </a>
        </li>
    </ul>
</nav>