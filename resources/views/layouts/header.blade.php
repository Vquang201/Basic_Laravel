<nav class="navbar navbar-expand-sm bg-dark">
    <div class="container-fluid" >
      <!-- Links -->
      <ul class="navbar-nav">
        <li class="nav-item text-white">
          <a 
            class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}" 
            href="/">Dashboard
          </a>
        </li>
        <li class="nav-item text-white">
          <a 
            class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}" 
            href="/post">Post
          </a>
        </li>
        <li class="nav-item">
          <a 
          class="nav-link text-white {{ request()->is('about') ? 'active' : '' }}" 
            href="/food/create">
            Create Blog
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="/food">Blog Posted</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="/user">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="/contact">Contact</a>
        </li>
      </ul>
    </div>
    @auth
      <div class="dropdown">
          <a class="dropdown-toggle nav-link text-white" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
          </a>
        
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="/user/{{Auth::user()->id}}">
                  Profile
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="/auth" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
              </a>
            </li>
          </ul>
      </div>
    @else
      <a href="/auth" class="nav-link text-white">Login/Register</a> 
    @endauth

  </nav>

<form id="logout-form" action="/logout" method="POST" style="display: none;">
    @csrf
</form>

<script>
    function logout() {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    }
</script>