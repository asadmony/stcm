<nav class="nav-bottom">
        <a href="{{ route('home') }}" class="nav-link @if (url()->current() == route('home')) active @endif">
            <i class="icon fa fa-home"></i><span class="text">Home</span>
        </a>
        <a href="{{ route('bookShift') }}" class="nav-link @if (url()->current() == route('bookShift')) active @endif">
            <i class="icon fas fa-calendar-check"></i><span class="text">Book Slot</span>
        </a>
        <a href="{{ route('history') }}" class="nav-link @if (url()->current() == route('history')) active @endif">
            <i class="icon fas fa-chart-line"></i><span class="text">History</span>
        </a>
        <a href="page-profile.html" class="nav-link">
            <i class="icon fa fa-user"></i><span class="text">Profile</span>
        </a>
    </nav> <!-- nav-bottom -->
