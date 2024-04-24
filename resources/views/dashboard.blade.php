@extends('main')

@section('title', 'Dashboard')

@section('page')
{{ Request::is('dashboard*') ? 'dashboard' : '' }}
@endsection

@section('content')
<div class="d-flex flex-column justify-content-between" style="height: 100%">
  <div class="d-flex header justify-content-center text-light mt-3 position-relative">
    @auth
    <a class="p-3 rounded position-absolute start-0" href="#" data-bs-toggle="modal" data-bs-target="#profilModal"><img src="{{ asset('img/icon-profil.svg') }}"></a>
    @endauth
    <h5 class="m-0 py-3 page-title">Dashboard</h5>
    @auth
    <a class="p-3 rounded position-absolute end-0" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><img src="{{ asset('img/icon-logout.svg') }}"></a>
    @endauth
  </div>

  <div class="amount text-light text-center">

    <div class="saldo mb-4">
      <h4 id="saldo-title">Saldo Kas</h4>
      @php
      $negative = false;
      if ($saldo < 0) { $saldo=abs($saldo); $negative=true; } @endphp <h2 id="saldo-amount">{{ $negative ? '- ' : '' }}@currency($saldo)</h2>
    </div>

    <div class="d-flex masuk-keluar justify-content-around">
      <div class="masuk">
        <div class="masuk-title d-flex justify-content-center align-items-center mb-1">
          <p class="m-0">Pemasukan</p>
          <img src="{{ asset('img/icon-down.svg') }}">
        </div>
        <h4>@currency($pemasukan)</h4>
      </div>
      <div class="divider">
        <img src="{{ asset('img/divider.svg') }}" alt="" style="height: 64px">
      </div>
      <div class="keluar">
        <div class="keluar-title d-flex justify-content-center align-items-center mb-1">
          <p class="m-0">Pengeluaran</p>
          <img src="{{ asset('img/icon-up.svg') }}">
        </div>
        <h4>@currency($pengeluaran)</h4>
      </div>
    </div>

  </div>

  <div class="last-transaction card mb-3">
    <ul class="list-group list-group-flush">
      <li class="list-group-item trx-this-month p-3">
        <h6 class="last-trx m-0">Transaksi baru baru ini</h6>
      </li>
      <li class="list-group-item overflow-y-scroll py-1" style="height: 18rem">
        <ul class="list-group list-group-flush">
          @foreach ($transactions as $transaction)
          @include('components.card-transaction')

          @endforeach
          @if(count($transactions) == 0)
          <p class="text-center">-- No data available --</p>
          @endif
        </ul>
  </div>
</div>

@include('modal.logout')
@auth
@include('modal.profil')
@endauth


@endsection
