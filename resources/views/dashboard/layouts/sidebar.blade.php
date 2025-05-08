<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/dashboard">
              <i class="bi bi-house-fill" style="color: #000000;"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/dashboard/pakets">
              <i class="bi bi-briefcase-fill" style="color: #000000;"></i>
              Paket
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/dashboard/deposit">
                <i class="bi bi-currency-dollar" style="color: #000000;"></i>
              Deposit
            </a>
          </li>
          @if (auth()->user()->is_admin == 0)
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/dashboard/riwayat_paket">
              <i class="bi bi-clock-history" style="color: #000000;"></i>
              Riwayat Transaksi
            </a>
          </li>
          @endif
          {{-- khusus admin --}}
          @if (auth()->user()->is_admin)
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/dashboard/gallery">
                <i class="bi bi-house" style="color: #000000;"></i>
              Gallery
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/dashboard/artikel">
              <i class="bi bi-newspaper" style="color: #000000;"></i>
              Artikel
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/dashboard/member">
              <i class="bi bi-person-fill-gear" style="color: #000000"></i>
              Data Jama'ah
            </a>
          </li>              
          @endif
          {{-- end khusus admin --}}
          

          <li class="nav-item">
            
            <a class="nav-link d-flex align-items-center gap-2" href="/">
              <i class="bi bi-card-image " style="color: #000000;"></i>
              Home
            </a>
          </li>

        </ul>

        

        <hr class="my-3">

        <ul class="nav flex-column mb-auto">        
          <li class="nav-item">
            
            <form action="/logout" method="post">
              @csrf  
              
              <button class="nav-link d-flex align-items-center gap-2">
                <i class="bi bi-door-open" style="color: #000000"></i>
              Logout </button>
            </form>              
          </li>
        </ul>
      </div>
    </div>
  </div>