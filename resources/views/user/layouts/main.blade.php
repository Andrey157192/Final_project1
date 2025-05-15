@include('user.layouts.header')

<main>
  @yield('content')
</main>

@include('user.layouts.footer')

@include('user.components.cookie-consent')
