<header>
  <div class="logo">
      <img src="/path/to/logo.png" alt="Logo">
  </div>
  
  @if(auth()->check())
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
  @endif
</header>