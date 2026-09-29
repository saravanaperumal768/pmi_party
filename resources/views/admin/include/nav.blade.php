<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
    <div class="sidebar-header">
        <a class="brand-mark" href="index.html" aria-label="PMI dashboard">
            <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
            <span class="brand-copy">
                <span class="brand-title">PMI</span>
                 @if (strtolower(trim(auth()->user()->posting)) == 'president')
                <span class="brand-subtitle">Admin</span>
                @else
                    <span class="brand-subtitle">Member</span>
                @endif
            </span>
        </a>
    </div>

    <nav class="sidebar-nav">
         @if (strtolower(trim(auth()->user()->posting)) == 'president')
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}">
            <span class="nav-icon">
                <i class="bi bi-speedometer2" aria-hidden="true"></i>
            </span>
            <span class="nav-text">Dashboard</span>
        </a>




        <a class="nav-link {{ request()->routeIs('admin.assign_role') ? 'active' : '' }}"
            href="{{ route('admin.assign_role') }}">
             <span class="nav-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
            <span class="nav-text">Assign Roles</span>
        </a>


        <a class="nav-link {{ request()->routeIs('admin.party_incharge') ? 'active' : '' }}"
            href="{{ route('admin.party_incharge') }}">
           <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
            <span class="nav-text">Party Incharges</span>
        </a>


        <a class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}"
            href="{{ route('admin.reports') }}">
           <span class="nav-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
            <span class="nav-text">Reports</span>
        </a>

        @else
        <a class="nav-link {{ request()->routeIs('admin.dashboard_member') ? 'active' : '' }}"
            href="{{ route('admin.dashboard_member')}}"
             >
            <span class="nav-icon">
                <i class="bi bi-window-stack" aria-hidden="true"></i>
            </span>
            <span class="nav-text">Member Dashboard </span>
        </a>


        @endif


    </nav>



    <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">Tamilaga Podhu Makkal Iyakkam</span>
    </div>
</aside>
