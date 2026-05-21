<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600&display=swap');

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .top-navbar {
        width: 100%;
        height: 68px;
        background: rgba(10, 14, 26, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 32px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
        font-family: 'Outfit', sans-serif;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
    }

    /* Brand / Logo Left Side */
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .navbar-brand .brand-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 0 14px rgba(99, 102, 241, 0.5);
    }

    .navbar-brand .brand-name {
        font-size: 17px;
        font-weight: 600;
        color: #f1f5f9;
        letter-spacing: 0.3px;
    }

    /* Right Side */
    .navbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* Notification Bell */
    .notif-btn {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 10px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #94a3b8;
        font-size: 17px;
        transition: all 0.2s ease;
        text-decoration: none;
        position: relative;
    }

    .notif-btn:hover {
        background: rgba(255,255,255,0.1);
        color: #f1f5f9;

        border-color: rgba(255,255,255,0.15);
        transform: translateY(-1px);
    }

    .notif-dot {
        position: absolute;
        top: 7px;
        right: 7px;
        width: 7px;
        height: 7px;
        background: #f43f5e;
        border-radius: 50%;
        border: 1.5px solid rgba(10, 14, 26, 0.9);
    }

    /* Divider */
    .nav-divider {
        width: 1px;
        height: 28px;
        background: rgba(255,255,255,0.08);
    }

    /* Profile Dropdown */
    .profile-dropdown {
        position: relative;
    }

    .profile-btn {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        color: #f1f5f9;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 5px 12px 5px 6px;
        transition: all 0.2s ease;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        font-weight: 500;
    }

    .profile-btn:hover {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.15);
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(0,0,0,0.3);
    }

    .profile-img {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        object-fit: cover;
        border: 1.5px solid rgba(99, 102, 241, 0.5);
    }

    .profile-btn .username {
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .profile-btn .chevron {
        font-size: 11px;
        color: #64748b;
        transition: transform 0.25s ease;
        margin-left: 2px;
    }

    .profile-btn.active .chevron {
        transform: rotate(180deg);
    }

    /* Dropdown Menu */
    .profile-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        width: 210px;
        background: rgba(15, 20, 35, 0.95);
        backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 14px;
        padding: 6px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.03);
        z-index: 10000;
        display: none;
        animation: menuFadeIn 0.18s ease;
    }

    .profile-menu.open {
        display: block;
    }

    @keyframes menuFadeIn {
        from { opacity: 0; transform: translateY(-6px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* User Info Header in Menu */
    .menu-user-info {
        padding: 10px 12px 12px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        margin-bottom: 6px;
    }

    .menu-user-info .menu-username {
        font-size: 14px;
        font-weight: 600;
        color: #f1f5f9;
        font-family: 'Outfit', sans-serif;
    }

    .menu-user-info .menu-role {
        font-size: 12px;
        color: #64748b;
        font-family: 'Outfit', sans-serif;
        margin-top: 2px;
    }

    /* Menu Items */
    .menu-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 9px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 14px;
        font-family: 'Outfit', sans-serif;
        font-weight: 400;
        transition: all 0.15s ease;
        cursor: pointer;
        border: none;
        background: transparent;
        width: 100%;
        text-align: left;
    }

    .menu-item:hover {
        background: rgba(255,255,255,0.07);
        color: #f1f5f9;
    }

    .menu-item .item-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .menu-item .item-icon.purple { background: rgba(99, 102, 241, 0.15); }
    .menu-item .item-icon.blue   { background: rgba(59, 130, 246, 0.15); }
    .menu-item .item-icon.red    { background: rgba(244, 63, 94, 0.12); }

    .menu-item.logout-item {
        color: #f43f5e;
        margin-top: 4px;
        border-top: 1px solid rgba(255,255,255,0.05);
        padding-top: 10px;
    }

    .menu-item.logout-item:hover {
        background: rgba(244, 63, 94, 0.1);
        color: #fb7185;
    }

    .logout-form { width: 100%; }
</style>

<nav class="top-navbar">

    {{-- Brand Left --}}
    <a href="{{ url('/') }}" class="navbar-brand">
        <div class="brand-icon">⚡</div>
        <span class="brand-name">AppName</span>
    </a>

    {{-- Right Side --}}
    <div class="navbar-right">

        {{-- Notification Bell --}}
        <a href="#" class="notif-btn" title="Notifications">
            🔔
            <span class="notif-dot"></span>
        </a>

        <div class="nav-divider"></div>

        {{-- Profile Dropdown --}}
      @php
    $user = auth()->user();
@endphp
@auth
<div class="profile-dropdown">
    <button class="profile-btn" id="profileToggle">

        {{-- Profile Image OR First Letter --}}
        @if($user->profile_image && file_exists(public_path('storage/' . $user->profile_image)))
            <img src="{{ asset('storage/' . $user->profile_image) }}"
                 class="profile-img" alt="profile">
        @else
            <div class="profile-img d-flex align-items-center justify-content-center"
                 style="background: linear-gradient(135deg,#6366f1,#8b5cf6);
                        color:white;
                        font-weight:600;
                        font-size:14px;">
                {{ strtoupper(substr($user->username,0,1)) }}
            </div>
        @endif

        <span class="username" id="goProfile">
            {{ $user->username }}
        </span>

        <span class="chevron" id="menuToggleIcon">▾</span>
    </button>

            <div class="profile-menu" id="profileMenu">
                {{-- User Info --}}
                <div class="menu-user-info">
                    <div class="menu-username">{{ auth()->user()->username }}</div>
                    <div class="menu-role">{{ auth()->user()->email }}</div>
                </div>

                {{-- Profile --}}
                <a href="{{ route('profile') }}" class="menu-item">
                    <span class="item-icon purple">👤</span>
                    My Profile
                </a>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="menu-item logout-item">
                        <span class="item-icon red">🚪</span>
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</nav>
@endauth
@guest
<div class="navbar-right">
    <a href="{{ route('login') }}" class="profile-btn">Login</a>
@endguest

<script>
    const toggleBtn = document.getElementById('profileToggle');
    const menu = document.getElementById('profileMenu');

    toggleBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.classList.toggle('open');
        toggleBtn.classList.toggle('active');
    });

    // Redirect to profile if username clicked
    document.querySelector('.username').addEventListener('click', function(e){
        e.stopPropagation();
        window.location.href = "{{ route('profile') }}";
    });

    // Close on outside click
    document.addEventListener('click', function(e) {
        if (!document.querySelector('.profile-dropdown').contains(e.target)) {
            menu.classList.remove('open');
            toggleBtn.classList.remove('active');
        }
    });
</script>
</script>
