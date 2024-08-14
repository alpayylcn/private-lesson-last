<!-- Navbar -->

<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar"
>
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  

  <ul class="navbar-nav flex-row align-items-center ms-auto">
    

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          
          
          
          @if (Auth::check())
          
          {{-- <img src="{{ Auth::user()->profile_image ?: '/no_image.jpg' }}" alt="Profil Resmi" style="width: 150px; height: 150px; border-radius: 50%;" /> --}}
        
        

          <img src="{{asset('backend/assets')}}/img/profileimages/{{ Auth::user()->userDetails->profile_image ?: '/no_image.jpg' }}" alt class="w-px-40 h-px-40 rounded-circle" />
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="#">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                  <img src="{{asset('backend/assets')}}/img/profileimages/{{ Auth::user()->userDetails->profile_image ?: '/no_image.jpg' }}" alt class="w-px-40 h-px-40 rounded-circle" />
                </div>
              </div>
              <div class="flex-grow-1">
                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                <small class="text-muted">Matematik</small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="#">
            <i class="bx bx-user me-2"></i>
            <span class="align-middle">My Profile</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="#">
            <i class="bx bx-cog me-2"></i>
            <span class="align-middle">Settings</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="">
            <span class="d-flex align-items-center align-middle">
              <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
              <span class="flex-grow-1 align-middle">Billing</span>
              <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
            </span>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        
        <li class="dropdown-item">
          
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <i class="flex-shrink-0 bx bx-log-out me-2"></i>
            <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Çıkış') }}
            </x-responsive-nav-link>
        </form>
        </li>
      </ul>
          @else
          <p>Lütfen giriş yapınız.</p>
        @endif

    </li>
    <!--/ User -->
  </ul>
</div>
</nav>

<!-- / Navbar -->