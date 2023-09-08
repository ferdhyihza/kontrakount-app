<!doctype html>
<html lang="en">
@include('components.head')
<body class="wrapper">
  <div class="container @yield('page')">
    @yield('content')
  </div>
  @include('components.navbar')
  @include('components.script')
</body>
</html>
