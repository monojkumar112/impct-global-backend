<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" style="display: flex; align-items: center; gap: 10px;" class="sidebar-brand">
           <img style="width: 45px; height: 45px;" src="{{ asset("assets/logo/logo.png") }}" alt="">
           <p style="font-size: 14px; font-weight: 600; color: #FFF;">Admin</p>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href={{ route('admin.dashboard') }} class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href={{ route('admin.contact_us.index') }} class="nav-link">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Contact Us</span>
                </a>
            </li>
            <li class="nav-item">
                <a href={{ route('admin.blogs.index') }} class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Blogs</span>
                </a>
            </li>
            <li class="nav-item">
                <a href={{ route('admin.services.index') }} class="nav-link">
                    <i class="link-icon" data-feather="briefcase"></i>
                    <span class="link-title">Services</span>
                </a>
            </li>
            <li class="nav-item">
                <a href={{ route('admin.how_we_works.index') }} class="nav-link">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">How We Work</span>
                </a>
            </li>
            {{-- <li class="nav-item nav-category">web apps</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                    aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/email/inbox.html" class="nav-link">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/compose.html" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

        </ul>
    </div>
</nav>
