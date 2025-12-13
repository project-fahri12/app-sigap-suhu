<header class="header">
    <div class="header-left">
        <button class="mobile-menu-btn" id="mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="header-right">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search...">
        </div>

        <div class="user-profile" id="userProfile">
            {{-- Avatar dari inisial --}}
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="user-info">
                <h4>{{ auth()->user()->username }}</h4>
                <p>{{ ucfirst(auth()->user()->role) }}</p>
            </div>

            <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>

            <!-- Dropdown -->
            <div class="profile-dropdown" id="profileDropdown">
                <a href="">
                    <i class="fas fa-user"></i> Profil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
