<!doctype html>
<html lang="en">
@include('components.head')
<body class="wrapper">
  <div class="container-nonav @yield('page')">
    @yield('content')
  </div>
  @include('components.script')
</body>
</html>
