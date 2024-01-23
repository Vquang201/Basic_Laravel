<nav class="navbar navbar-expand-sm bg-dark">
    <div class="container-fluid">
      <!-- Links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a 
            class="nav-link {{ request()->is('/') ? 'active' : '' }}" 
            href="/food">Home
          </a>
        </li>
        <li class="nav-item">
          <a 
          class="nav-link {{ request()->is('about') ? 'active' : '' }}" 
            href="/food/create">
            Create A Food
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/post">Post</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact">Contact</a>
        </li>
      </ul>
    </div>      
  </nav>