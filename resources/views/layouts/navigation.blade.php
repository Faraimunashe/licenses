<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin-registrations') }}">
                    <i class="bi bi-clipboard"></i>
                    <span>Registrations</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin-transactions') }}">
                <i class="bi bi-coin"></i>
                <span>Transactions</span>
                </a>
            </li><!-- End Error 404 Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin-companies') }}">
                <i class="bi bi-briefcase"></i>
                <span>Companies</span>
                </a>
            </li><!-- End Error 404 Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin-fees') }}">
                <i class="bi bi-briefcase"></i>
                <span>Fees</span>
                </a>
            </li><!-- End Error 404 Page Nav -->

        @elseif (Auth::user()->hasRole('user'))
            @if(registered_company(Auth::id()))
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('company-license') }}">
                        <i class="bi bi-card-checklist"></i>
                        <span>License & Permits</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('company-reports') }}">
                        <i class="bi bi-clipboard-data"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('company-transactions') }}">
                        <i class="bi bi-card-list"></i>
                        <span>Transactions</span>
                    </a>
                </li>
            @endif
        @endif

        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="bi bi-lock"></i>
            <span>Logout</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>
</aside>
