<!doctype html>
<html lang="en">
@include('components.head')
<body class="wrapper">
  <div class="container text-center login-page d-flex flex-column align-items-center justify-content-between py-5">
    <div class="mt-5">
      <h1 class="title">KontraKount</h1>
      <h6 class="subtitle">Silakan login dengan akun google Anda</h6>
    </div>
    {{-- <img class="w-75" src="{{ asset('img/login-page.svg') }}" alt=""> --}}
    <a href="{{ route('auth.google') }}" class="btn btn-login-google p-2">
      <div class="d-flex gap-3 p-1">
        <img class="logo-google" src="{{ asset('img/google-logo.png') }}" alt="">
        <h4 class="d-flex align-items-center m-0 title-login-google">Continue with Google</h4>
      </div>
    </a>
  </div>
  @include('components.script')

</body>
</html>
