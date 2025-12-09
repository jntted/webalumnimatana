<!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="/" class="logo">
              <img src="assets/images/logo_matana.png" alt="Matana University">
            </a>
            <!-- ***** Logo End ***** -->

            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="/" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="{{ url('/#forum') }}">Information</a></li>
              <li class="scroll-to-section"><a href="#about">Forum</a></li>
              @auth
                <li class="scroll-to-section"><a href="/profil">Profil</a></li>
                <li class="scroll-to-section"><a href="/alumni">List</a></li>
              @else
                <li class="scroll-to-section"><a href="/profil">Profil</a></li>
                <li class="scroll-to-section"><a href="/alumni">List</a></li>
                <li></li>
              @endauth
            </ul>

            <!-- Profile Picture & Auth Section -->
            <div class="header-auth flex-end
               items-center gap-4">
              @auth
                <div class="relative group">
                  @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}"
                      class="w-10 h-10 rounded-full cursor-pointer object-cover border-2 border-indigo-500">
                  @else
                    <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center cursor-pointer">
                      <i class="fas fa-user text-white"></i>
                    </div>
                  @endif
                  
                  <!-- Dropdown Menu -->
                  <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50">
                    <a href="/profil" class="block px-4 py-2 text-slate-700 hover:bg-slate-100 rounded-t-lg">
                      <i class="fas fa-user mr-2"></i>Profil Saya
                    </a>
                    <a href="/logout" class="block px-4 py-2 text-rose-600 hover:bg-rose-50 rounded-b-lg">
                      <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                  </div>
                </div>
              @else
                <div class="gradient-button">
                  <a href="/login"><i class="fa fa-sign-in-alt"></i> Sign In Now</a>
                </div>
              @endauth
            </div>

            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->